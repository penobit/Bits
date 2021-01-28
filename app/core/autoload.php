<?php 
global $iLite, $ilite, $loader;

// check if SSL enabled
$ssl = isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] && $_SERVER["HTTPS"] != "off" ? true : false;
define("SSL_ENABLED", $ssl);

// URL of application root
$rootDir = trim(str_replace("\\", "/", dirname($_SERVER["SCRIPT_NAME"])), "/");
$appURL = (SSL_ENABLED ? "https" : "http")."://".$_SERVER["SERVER_NAME"].($rootDir == '' ? '' : '/').$rootDir;
define('BASE_PATH', $rootDir);
define("APP_URL", $appURL);

// Languages directory path
define("LANG_PATH", APP_PATH.'/languages');

// include base classes and helpers
require_once APP_PATH.'/config/config.php';
require_once APP_PATH.'/helpers/helpers.php';
require_once APP_PATH.'/core/Autoloader.php';

// instantiate the loader
$loader = new Autoloader;

// register the autoloader
$loader->register();

// register the base directories for auto loading
$loader->addBaseDir(APP_PATH.'/vendor');
$loader->addBaseDir(APP_PATH.'/iLite');
$loader->addBaseDir(APP_PATH.'/lib');
$loader->addBaseDir(APP_PATH.'/core');
$loader->addBaseDir(CONTROLLER_PATH);
$loader->addBaseDir(MODEL_PATH);
$loader->addBaseDir(PLUGIN_PATH);

// iLite framework file
require_once APP_PATH.'/iLite/iLite.php';

// comser autoload file
require_once APP_PATH.'/vendor/autoload.php';

// instantiate the iLite Framework class
$iLite = $ilite = new iLite(false);

// adding main routes
require_once APP_PATH.'/core/Routes.php';
