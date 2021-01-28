<?php

/*
 * @author Penobit <info@penobit.com>
 * @copyright © penobit.com (Penobit.com), all rights received
 * @license https://penobit.com/license/penobit/cms
 * @version 1.0.8
 * @link https://penobit.com
 * @link https://Penobit.com
 */

define('HTTP_VERSION', 'NIK-1.0');

class http {
    public $response;
    public $ch;
    public $soapServer;
    public $cookieFile;
    public $cookieJar;
    public $headers;

    public function __construct() {
        $this->ch = curl_init();
        $this->cookieFile = tempnam('/tmp', 'CURLCOOKIE');
        $this->cookieJar = tempnam('/tmp', 'CURLCOOKIE');
        $this->headers = [];
        $this->referer = false;
    }

    public function get_page($url) {
        return $this->get($url, []);
    }

    public function build_query($data = [], $url_decode = true) {
        $query = http_build_query($data);
        if ($url_decode) {
            $query = urldecode($query);
        }

        return $query;
    }

    public function get_headers() {
        $headers = [];
        foreach ($this->headers as $key => $value) {
            $headers[] = "$key: $value";
        }

        return $headers;
    }

    public function post($url, $data = []) {
        if (empty($url)) {
            return false;
        }
        $http_query = is_string($data) ? $data : $this->build_query($data);
        curl_setopt($this->ch, CURLOPT_HEADER, false);
        curl_setopt($this->ch, CURLOPT_HTTPHEADER, $this->get_headers());
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($this->ch, CURLOPT_COOKIEJAR, $this->cookieJar);
        curl_setopt($this->ch, CURLOPT_COOKIEFILE, $this->cookieFile);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->ch, CURLOPT_URL, $url);
        if (is_array($data)) {
            curl_setopt($this->ch, CURLOPT_POST, count($data));
        }
        if (!empty($this->referer)) {
            curl_setopt($this->ch, CURLOPT_REFERER, $this->referer);
        }
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, $http_query);

        $response = curl_exec($this->ch);

        if (!$response) {
            throw new PBX('CURL ERROR: '.(curl_error($this->ch) ?: __('Unknown Error')));
        }

        return $this->response = $response;
    }

    public function post_json($url, $data = []) {
        $this->headers['Content-Type'] = 'application/json';

        return $this->post($url, json($data));
    }

    public function get($url, $data = []) {
        if (isset($data)) {
            $url .= '?'.$this->build_query($data, false);
        }
        $http_query = is_string($data) ? $data : $this->build_query($data);
        curl_setopt($this->ch, CURLOPT_HEADER, false);
        curl_setopt($this->ch, CURLOPT_HTTPHEADER, $this->get_headers());
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($this->ch, CURLOPT_COOKIEJAR, $this->cookieJar);
        curl_setopt($this->ch, CURLOPT_COOKIEFILE, $this->cookieFile);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->ch, CURLOPT_URL, $url);
        if (!empty($this->referer)) {
            curl_setopt($this->ch, CURLOPT_REFERER, $this->referer);
        }
        $response = curl_exec($this->ch);

        if (false === $response || null === $response) {
            return 'CURL ERROR: '.(curl_error($this->ch) ?: __('Unknown Error'));
        }

        $this->response = $response;

        return $response;
    }

    public function close() {
        curl_close($this->ch);
        $this->ch = null;

        return true;
    }
}
