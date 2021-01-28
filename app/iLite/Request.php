<?php
/**
 * Class Request
 * Manage request params.
 *
 * @author R8
 */
class Request {
    private $get;
    private $post;
    private $files;
    private $server;
    private $cookie;
    private $method;
    private $requested_uri;
    private $body = null;

    public function __construct(array $GET = [], array $POST = [], array $FILES = [], array $SERVER = [], array $COOKIE = []) {
        $this->get = $GET;
        $this->post = $POST;
        $this->files = $FILES;
        $this->server = $SERVER;
        $this->cookie = $COOKIE;
        $this->method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $this->requested_uri = preg_replace(sprintf('/^\/%s/', BASE_PATH), '', $_SERVER['REQUEST_URI']) ?? '/';
    }

    public static function createFromGlobals() {
        return new Request($_GET, $_POST, $_FILES, $_SERVER, $_COOKIE);
    }

    /**
     * Get query param passed by URL.
     *
     * @param $key
     *
     * @return value or false
     */
    public function get($key) {
        return $this->get[$key] ?? false;
    }

    /**
     * Get post variables.
     *
     * @param $key
     *
     * @return value or false
     */
    public function post($key) {
        return $this->post[$key] ?? false;
    }

    public function server($key) {
        return $this->server[$key] ?? false;
    }

    public function cookie($key) {
        return $this->cookie[$key] ?? false;
    }

    /**
     * Returns the Request Body content from POST,PUT
     * For more info see: http://php.net/manual/en/wrappers.php.php.
     */
    public function getBody() {
        if (null == $this->body) {
            $this->body = file_get_contents('php://input');
        }

        return $this->body;
    }

    /**
     * Get headers received.
     *
     * @param $key
     *
     * @return value or false
     */
    public function header($key) {
        return isset($_SERVER['HTTP_'.strtoupper($key)]) ? $_SERVER['HTTP_'.strtoupper($key)] : false;
    }

    public function getMethod() {
        return $this->method;
    }

    public function getRequestedUri() {
        $uri = $this->requested_uri;
        $uri = preg_replace('/[\/]+/', '/', $uri);

        return $uri;
    }
}