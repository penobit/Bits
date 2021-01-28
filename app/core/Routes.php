<?php
/*
 * @author Penobit <info@penobit.com>
 * @copyright © penobit.com (Penobit.com), all rights received
 * @license https://penobit.com/license/penobit/cms
 * @version 1.0.8
 * @link https://penobit.com
 * @link https://Penobit.com
 */

global $iLite;

$iLite->addRoute('GET', '/', 'Home')
	->addRoute('GET', '/bundles/[*:id].[css|js:type]', 'Bundle')
	->addRoute('GET', '/auth/?[login|register|forget-password|reset-password:action]?', 'Auth')
	->addRoute('GET', '/panel/?', 'Dashboard');

$iLite->addRoute('GET', '/translate', function() {
	$lang = $_REQUEST['language'];
	$tr = new Penobit\GoogleTranslate\GoogleTranslate($lang);
	$data = json_decode($_REQUEST['data']) ?: [$_REQUEST['data']];
	$res = [];

	foreach ($data as $str) {
		if (empty(trim($str))) {
			$res[] = $str;
			continue;
		}
		$translated = $tr->translate($str);
		$res[] = $translated;
	}

	if (count($res) === 1) {
		Header::text();
	} else {
		Header::json();
	}

	echo count($res) === 1 ? array_shift($res) : json_encode($res, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
}, 'translate');

$iLite->addRoute('GET', '/about', function() {
	$View = new View(activeTemplate('path').'/about.php');
	$title = __('About iLite');
	$View->setTitle($title);
	$View->render();
});
$iLite->addRoute('GET', '/features', function() {
	$View = new View(activeTemplate('path').'/features.php');
	$title = __('iLite Features');
	$View->setTitle($title);
	$View->render();
});
$iLite->addRoute('GET', '/admin-events', function() {
	Header::eventStream();

	$data = [
		'message' => 'test',
		'from' => 'system',
		'time' => time()
	];
	$data = json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

	// SysMessage
	echo sprintf('event: %s', 'sysmessage');
	echo "\n";
	echo sprintf('data: %s', $data);
	echo "\n\n";

	// UserMessage
	echo sprintf('event: %s', 'usermessage');
	echo "\n";
	echo sprintf('data: %s', json_encode(['message' => 'msg', 'from' => 'ilite']));
	echo "\n\n";

	flush();
});

$iLite->setRouterFallback(function($params) {
	$uri = $params['uri'];
	$slug = basename($uri);
	$Post = new PostModel($slug, 'post_slug');

	if ($Post->isAvailable()) {
		Header::text();
		var_dump($Post);
	} else {
		iLite::notFound();
    }
});

// $tr = new Gettext\Translator;
// $translations = new Gettext\Translations();
// $translation = new Gettext\Translation(null, 'penobit');
// $translation->setTranslation('پنوبیت');
// $translations[] = $translation;
// $x = Gettext\Generators\Po::toFile($translations, LANG_PATH.'/fa2.po');
// var_dump($x);
// exit;

// $translations = Gettext\Translations::fromPoFile(LANG_PATH.'/fa.po');
// $tr->loadTranslations($translations);
// $trans = $translations->find(null, 'one Comment');
// $trans->setPluralTranslation('%s نظر');
// var_dump($trans);exit;
// $tr->loadTranslations($translations);
// $tr->register();

// Header::css();
// $scss = new ScssPhp\ScssPhp\Compiler();
// $scss->addImportPath('assets/themes/iLite/assets/css');
// $file = activeTemplate('path').'/assets/css/style.scss';
// $compiled = $scss->compile(file_get_contents($file));
// echo($compiled);exit;