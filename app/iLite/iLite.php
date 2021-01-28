<?php

/**
 * @package iLite Framework
 * @author Penobit <info@penobit.com>
 * @copyright © penobit.com (Penobit.com), all rights received
 * @license https://penobit.com/license/penobit/cms
 * @version 1.0.8
 * @see https://penobit.com
 * @see https://Penobit.com
 */

const ENV_DEV = 0;
const ENV_PROD = 1;

class iLite {
	//instances vars and predefined configs
	public static $language;
	public $translator;
	protected $production = false;
	protected $databseHandles = [];
	protected $routes = [];
	protected $subdomainRoutes = [];
	protected $router;
	protected $routeCallable;
	protected $controller;

	/**
	 * Initialize Framework Core.
	 *
	 * @param bool $production Enviroment, set to false for Enable Debugging
	 */
	public function __construct($production = false) {
		$this->controller = new Controller();

		// Setting Environment
		$this->setEnvironment($production);

		// Setting up Router
		$router = new AltoRouter();
		$router->setBasePath(BASE_PATH);
		$router->addMatchTypes([
			'lang' => '[a-zAz]{2}'
		]);
		$this->setRouter($router);
		$this->routes = [];
	}

	/**
	 * Initialze a PDO database connection.
	 */
	public function db(string $driver = 'mysql', array $config = [], &$databaseObject = null) {
		if (empty($driver)) {
			$driver = DB_DRIVER;
		}

		$default_config = [
			'driver' => $driver,
			'host' => DB_HOST,
			'database' => DB_NAME,
			'username' => DB_USER,
			'password' => DB_PASSWORD,
			'charset' => DB_CHARSET,
			'collation' => DB_COLLATION,
			'prefix' => DB_PREFIX,
			'options' => [
				\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
			]
		];
		$config = array_merge($default_config, $config);
		$databaseID = sprintf('iDB-%s-%s', $driver, md5(serialize($config)));

		if (isset($this->databseHandles[$databaseID])) {
			return new \Pixie\QueryBuilder\QueryBuilderHandler($this->databseHandles[$databaseID]);
		}

		$this->databseHandles[$databaseID] = new \Pixie\Connection('mysql', $config, 'iDB');
		$db = new \Pixie\QueryBuilder\QueryBuilderHandler($this->databseHandles[$databaseID]);
		$this->dbEvents();

		return $db;
	}

	public function dbEvents() {
		iDB::registerEvent('after-update', 'options', function() {
			$options = new OptionsModel();
			$options->cacheOptions();
		});

		iDB::registerEvent('after-delete', 'options', function() {
			$options = new OptionsModel();
			$options->cacheOptions();
		});

		iDB::registerEvent('after-insert', 'options', function() {
			$options = new OptionsModel();
			$options->cacheOptions();
		});

		return $this;
	}

	/*
	 * Get framework Directory
	 */
	public function getRootDir() {
		return ROOT_PATH;
	}

	/**
	 * Change environment to prod or not.
	 *
	 * @param $production bool
	 */
	public function setEnvironment($production = false) {
		$this->prod = $production ? ENV_PROD : ENV_DEV;
	}

	/**
	 * Change environment to prod or not.
	 */
	public function setRouter(AltoRouter $router) {
		$this->router = $router;
	}

	/**
	 * Get Router object.
	 */
	public function getRouter() {
		return $this->router;
	}

	/**
	 * Get current language.
	 *
	 * @return string language code
	 */
	public static function getLanguage() {
		return self::$language ?? '';
    }
    
    /**
     * Get language data by language code (en, fa, fr, etc)
     * 
     * @param string $languageCode language code (en, fa, fr, etc), if not set default language will be set
     * @return StdClass language data
     */
    public static function getLanguageData(string $languageCode = ''){
        if (empty($languageCode)) {
            $languageCode = self::getDefaultLanguage();
        }

		$langsPath = APP_PATH.'/data/languages.json';
		$langs = file_get_contents($langsPath);
		$langs = json_decode($langs);

		return $langs->{$languageCode} ?? null;
    }

	/**
	 * Returns application default language from options table in database.
	 */
	public static function getDefaultLanguage() {
		$options = new OptionsModel();

		return $options->get('language');
	}

	/**
	 * returns current subdomain(s).
	 *
	 * @param bool $asArray if sets to true function returns array of subdomains otherwise returns string
	 */
	public function getSubdomain(bool $asArray = false) {
		$host = parse_url(APP_URL, PHP_URL_HOST);
		$subdomain = explode('.', $host);
		$ext = array_pop($subdomain);
		if ('localhost' !== $ext) {
			$ext = array_pop($subdomain);
		}

		if (empty($subdomain)) {
			return null;
		}

		return ($asArray ? $subdomain : join('.', $subdomain)) ?? false;
	}

	/**
	 * Look for match request in routes, execute the callback function.
	 */
	public function route() {
		$router = $this->getRouter();
		$subdomain = $this->getSubdomain();
		$routes = $this->getRoutes($subdomain);
		$router->addRoutes($routes);
		$route = $router->match();

		if (empty($route)) {
			self::notFound();
		}

		$route = (object) $route;
		$callback = $route->target;
		self::$language = $this->getDefaultLanguage();

		if (isset($route->params['iLiteLanguageParameter']) && !empty($route->params['iLiteLanguageParameter'])) {
			self::$language = $route->params['iLiteLanguageParameter'];
			if (isset($route->params['iLiteLanguageParameter'])) {
				unset($route->params['iLiteLanguageParameter']);
			}
		}

		$this->i18n();

		if (is_array($callback)) {
			[$controllerFile, $controller] = $callback;
			require_once $controllerFile;
		} else {
			if (is_callable($callback)) {
				$this->routeCallable = $callback;
				$callback = '';
			}
			$controller = sprintf('%sController', $callback);
		}

		$this->controller = new $controller();
		$this->controller->setVariable('route', $route);
	}

	/**
	 * get translator object.
	 */
	public function getTranslator() {
		return $this->translator ?? null;
	}

	/**
	 * set translator object.
	 *
	 * @param Gettext\Translator $translator translator object
	 */
	public function setTranslator(Gettext\Translator $translator) {
		return $this->translator = $translator;
	}

	/**
	 * initialize multilingual stuff.
	 */
	public function i18n() {
		$translator = new Gettext\Translator();
		$translator->register();
		$file = sprintf('%s/%s.po', LANG_PATH, $this->getLanguage());

		if (file_exists($file)) {
			$translations = Gettext\Translations::fromPoFile(LANG_PATH.'/fa.po');
			$translator->loadTranslations($translations);
		}

		$this->setTranslator($translator);

		return $this;
	}

	/**
	 * Run application.
	 */
	public function process() {
		$this->db();
		$this->route();
		if (isset($this->routeCallable)) {
			$process = $this->routeCallable;
			call_user_func($process, $this->controller->getVariable('route')->params);
		} else {
			$this->controller->process();
		}
	}

	/**
	 * Set router fallback
	 * if no matched routes found fallback will be called.
	 *
	 * @param string|array|callable $fallback Fallback function or controller class
	 */
	public function setRouterFallback($fallback) {
		$this->routerFallback = $fallback;

		return $this;
	}

	/**
	 * Get application's router.
	 *
	 * @param string|null $subdomain if set function returns specified subdomain routes
	 */
	public function getRoutes($subdomain = null) {
		if (!isset($subdomain)) {
			$this->addRoute('GET', '/[**:uri]', $this->routerFallback);
		}

		$routes = isset($subdomain) ? ($this->subdomainRoutes[$subdomain] ?? []) : ($this->routes ?? []);

		return $routes;
	}

	/**
	 * Add route to application router.
	 */
	public function addRoute(string $method, string $route, $callback, string $subdomain = null) {
		if ('/' === $route) {
			$route = '/?[lang:iLiteLanguageParameter]?';
		} else {
			$route = '/?[lang:iLiteLanguageParameter]?'.$route;
		}
		if (isset($subdomain) && !empty($subdomain)) {
			if (!isset($this->subdomainRoutes[$subdomain])) {
				$this->subdomainRoutes[$subdomain] = [];
			}
			$this->subdomainRoutes[$subdomain][] = [$method, $route, $callback];
		} else {
			$this->routes[] = [$method, $route, $callback];
		}

		return $this;
	}

	/**
	 * Get current enviroment.
	 *
	 * @return bool True if Production is ON
	 */
	public function getEnvironment() {
		return $this->prod ? ENV_PROD : ENV_DEV;
	}

	/**
	 * Encrypt data with specific key.
	 *
	 * @param string|array|object $data     Data to encrypt
	 * @param string              $password Encryption key
	 * @param int                 $method   Encryption method
	 */
	public static function encrypt($data = '', string $password = '#S3CuRe_ENcRYpTi0N@iLite', string $method = 'aes-256-cbc-hmac-sha256') {
		if (!is_string($data)) {
			try {
				$data = @serialize($data);
			} catch (Exception $e) {
				return false;
			}
		}

		return openssl_encrypt($data, $method, $password);
	}

	/**
	 * Decrypt encrypted data with iLite::encrypt() function.
	 *
	 * @param string $password Encryption key
	 * @param int    $method   Encryption method
	 */
	public static function decrypt(string $encoded_data, string $password = '#S3CuRe_ENcRYpTi0N@iLite', string $method = 'aes-256-cbc-hmac-sha256') {
		$data = openssl_decrypt($encoded_data, $method, $password);
		if ($unserialized = @unserialize($data)) {
			return $unserialized;
		}

		return $data;
	}

	/**
	 * Creates a GUID.
	 */
	public static function guid() {
		if (true === function_exists('com_create_guid')) {
			return trim(com_create_guid(), '{}');
		}

		return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
	}

	/**
	 * warn the browser that the page doesn't exists.
	 */
	public static function notFound() {
		Header::notFound();
        $View = new View(VIEW_PATH.'/pages/error.php', [
            'code' => 404,
            'description' => 'Not found',
            'message' => 'Requested page does not exists'
        ]);
		$View->render();
	}
}
