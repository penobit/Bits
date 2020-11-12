<?php
require_once('src/Penobit/PenoLite.php');

/*
* Remember remove this examples to avoid collisions in routes
*/
//load Micro Framework with debug enabled
$app = new \Penobit\App();

$app->get('/', function() use ( $app ){//Action on the Root URL
    echo 'Hello world';
});

//simple Json Response example
$app->get('/json/:name', function( $name ) use ( $app ){
    return $app->JsonResponse(array('name' => $name));
});

//test with slug in URL ( ':name' = '{name}' )
$app->get('/:name/:priv', function( $name, $priv ) use ( $app ){
    echo "<h1> Hello $name <small> $priv </small> </h1>";
});

$app->respond( function() use ( $app ){
    return $app->ResponseHTML('<p> This is a response with code 404. </p>', 404);
});

//Run
$app->listen();
