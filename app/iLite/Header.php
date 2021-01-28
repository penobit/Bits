<?php

/*
 * @author Penobit <info@penobit.com>
 * @copyright © penobit.com (Penobit.com), all rights received
 * @license https://penobit.com/license/penobit/cms
 * @version 1.0.8
 * @link https://penobit.com
 * @link https://Penobit.com
 */

class Header {
    public function __construct() {
        header('Cache-Control: public static');
        header('Expires: Mon, 26 Jul 2027 05:00:00 GMT');
    }

    public static function remove($header = null) {
        return $header ? header_remove($header) : header_remove();
    }

    public static function list() {
        return headers_list();
    }

    public static function cache($expire = '1 month') {
        $time = time();
        $expire = strtotime("$expire");
        $max = $expire - $time;
        // session_cache_limiter('none');
        header('Last-Modified: '.gmdate('D, d M Y H:i:s', strtotime('-12 hours')).' GMT');
        header_remove('pragma');
        header('Cache-control: max-age='.$max);
        header('Expires: '.gmdate(GMTDATE, $expire));
    }

    public static function noCache() {
        header('Expires: Mon, 26 Jul 1990 05:00:00 GMT');
        header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
        header('Cache-Control: no-store, no-cache, must-revalidate');
        header('Cache-Control: post-check=0, pre-check=0', false);
        header('Pragma: no-cache');
    }

    public static function notFound() {
        // header('HTTP/1.0 404 Not Found');
        return http_response_code(404);
    }

    public static function forbidden() {
        return http_response_code(403);
    }

    public static function redirect($url, $code = 302) {
        if (is_bool($code)) {
            $code = $code ? 301 : 302;
        }
        if (302 == $code) {
            http_response_code(302);
            header('Cache-Control: private');
            header('Vary: User-Agent, Accept-Encoding');
        } else {
            http_response_code($code);
        }
        header("Location: $url");
        exit;
    }

    public static function to($mime, $characterSet = 'UTF-8') {
        header('content-type:'.$mime.";charset=$characterSet", true);
    }

    public static function text() {
        self::to('text/plain');
    }

    public function eventStream() {
        Header::noCache();
        return self::to('text/event-stream');
    }

    public static function xml() {
        self::to('text/xml');
    }

    public static function js() {
        self::to('Application/javascript');
    }

    public static function css() {
        self::to('text/css');
    }

    public static function html() {
        self::to('text/html');
    }

    public static function json() {
        self::to('Application/JSON');
    }

    public static function excel() {
        header('Content-Type: application/vnd.ms-excel');
    }

    public static function __download(...$params) {
        return self::prepare_download(...$params);
    }

    public static function prepareDownload($name = null, $file = null, $content_type = 'application/octet-stream') {
        if (empty($name) && !empty($file)) {
            $name = basename($file);
        }
        if (empty($name)) {
            $name = pb_encrypt(time());
            $name = sanitize::filename($name);
        }

        header('Content-Description: File Transfer');
        header('Content-Type: '.$content_type);
        header('Content-Disposition: attachment; filename="'.$name.'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public static');
        header('Content-Length: '.filesize($file));

        if (is_file($file)) {
            readfile($file);
        }

        return true;
    }

    public static function canonical($link) {
        $canonical = 'Link: <'.$link.'>; rel="canonical"';
        header($canonical);

        return true;
    }
}
