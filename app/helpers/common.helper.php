<?php

/*
 * @author Penobit <info@penobit.com>
 * @copyright © penobit.com (Penobit.com), all rights received
 * @license https://penobit.com/license/penobit/cms
 * @version 1.0.8
 * @link https://penobit.com
 * @link https://Penobit.com
 */

// set_exception_handler('exception_handler');

function exception_handler($exception) {
    // echo sprintf("Uncaught %s exception: %s (%s:%s)" , get_class($exception), $exception->getMessage(), $exception->getFile(), $exception->getLine()), "<br>";
    // echo sprintf('<pre>%s</pre>', $exception->getTraceAsString());
    $ErrorController = new ErrorController([]);
    $ErrorController->process();
    exit;
}

function isLocalhost(){
    return $_SERVER['SERVER_ADDR'] === '127.0.0.1';
}

function session(string $key = '', $value = null) {
    if(!empty($key) && isset($value)){
        return $_SESSION[$key] = $value;
    }elseif(empty($key) && isset($value)){
        throw new Exception('Session key cannot be empty');
    }
    
    if(empty($key)){
        return $_SESSION;
    }

    return $_SESSION[$key] ?? null;
}

function url(string $path = '') {
    $path = trim($path, '/');
    $language = iLite::getLanguage() !== iLite::getDefaultLanguage() ? sprintf('%s/', iLite::getLanguage()) : '';
    
    return APP_URL."/{$language}{$path}";
}

function notFound() {
    $file = 'assets/themes/panel/error-404.php';
    $View = new View($file, ['requestedPage' => $_SERVER['REQUEST_URI']]);
    $View->render();
    exit;
}

function activeTemplate(string $return = 'name'){
    $optionModel = new OptionsModel;
    $template = $optionModel->get('template');
    if(empty($template)) return null;

    if($return === 'path'){
        return sprintf('%s/themes/%s', ASSET_PATH, $template);
    }elseif($return === 'url'){
        return url(sprintf('assets/themes/%s', $template));
    }elseif($return === 'name'){
        return $template;
    }

    return $template;
}