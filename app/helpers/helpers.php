<?php
/* Include all files in app helpers folder */
$helperFiles = scandir(APP_PATH.'/helpers');
array_map(function($file){
    if(!in_array($file, ['.', '..'])) require_once sprintf(APP_PATH.'/helpers/%s', $file);
}, $helperFiles);