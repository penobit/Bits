<?php

/**
 * @author Penobit <info@penobit.com>
 * @copyright © Penobit.com, all rights received
 * @license https://penobit.com/license/iLite
 * @see https://Penobit.com
 * @see https://GitHub.com/Penobit/iLite
 * @version 1.0.8
 */

error_reporting(E_ALL);
ob_start('ob_gzhandler') || ob_start();

// root path constants
define('ROOT_PATH', __DIR__);
define('APP_PATH', __DIR__.'/app');


// starting a session
session_name('iLite-session');
session_start();

// adding AppRoot directory to PHP include path and requiring autoload file
set_include_path(get_include_path().PATH_SEPARATOR.ROOT_PATH);
require_once APP_PATH.'/core/autoload.php';

// Process user request
$iLite->process();