<?php
/**
 *  Common configs 
 */

// Define constants
define('INC_PATH', ROOT_PATH.'/inc');
define('CONTROLLER_PATH', APP_PATH.'/controllers');
define('MODEL_PATH', APP_PATH.'/models');
define('LOG_PATH', APP_PATH.'/logs');
define('PLUGIN_PATH', ROOT_PATH.'/inc/plugins');
define('ASSET_PATH', ROOT_PATH.'/assets');
define('VIEW_PATH', ASSET_PATH.'/views');

// Defaullt multibyte encoding
mb_internal_encoding("UTF-8"); 

/* Include all files in app config folder */
$configFiles = scandir(APP_PATH.'/config');
array_map(function($file){
    if(!in_array($file, ['.', '..'])) require_once sprintf(APP_PATH.'/config/%s', $file);
}, $configFiles);