<?php
function view(string $path, array $vars = []) {
    $view = View::instance();
    $view->load($path, $vars);

    return $view;
}

function str_starts($key, $str, $caseSesitive = false) {
    if (!$key || !$str) {
        return false;
    }
    if (!$caseSesitive) {
        $str = mb_strtolower($str);
        $key = mb_strtolower($key);
    }
    $len = \mb_strlen($key);
    $start = mb_substr($str, 0, $len);

    return $start == $key ? $start : false;
}

function str_ends($key, $str, $caseSesitive = false) {
    if (!$key || !$str) {
        return false;
    }
    if (!$caseSesitive) {
        $str = mb_strtolower($str);
        $key = mb_strtolower($key);
    }
    $len = -\mb_strlen($key);
    $end = mb_substr($str, $len);

    return $end == $key ? $end : false;
}

function str_cut($key, $string, $side = 'trim', $trim = true) {
    if (empty($key) or empty($string)) {
        return false;
    }
    $key = preg_quote($key, '/');
    $string = ('left' == $side or 'trim' == $side) ? preg_replace("/^$key+/usi", '', $string) : $string;
    $string = ('right' == $side or 'trim' == $side) ? preg_replace("/$key+\$/usi", '', $string) : $string;

    return $string = $trim ? trim($string) : $string;
}

function pbDirection() {
    return 'rtl';
}

function getOption() {
    return '';
}

function blogInfo($x) {
    return $x;
}

function isHTML($string) {
    if (!$string) {
        return false;
    }

    return strip_tags($string) !== $string;
}

function keys($input = null) {
    if (!$input) {
        return false;
    }
    if (is_object($input)) {
        $input = to_array($input);
    }

    return @array_keys($input);
}

function values($input = null) {
    if (!$input) {
        return false;
    }
    if (is_object($input)) {
        $input = to_array($input);
    }

    return @array_values($input);
}
