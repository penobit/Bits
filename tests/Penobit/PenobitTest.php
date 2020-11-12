<?php
//load
require_once(__DIR__.'/../../src/Penobit/PenoLite.php');

/**
 * Class PenobitTest
 * @author Julio Cesar Martin - juliomatcom@gmail.com
 * @version 0.2.0
 */
class PenobitTest extends PHPUnit_Framework_TestCase
{

    /*
     * Try the match routes system
     */
    public function testRouteMatch()
    {
        //static route
        $this->tryMatch('/','/', array());

        /* Dynamic routes */
        //with :slug

        //Do NOT match
        $this->tryMatch('/hello/:name','/hello/', array(), false);

        $this->tryMatch('/hello/:name','/hello/juliomatcom', array(
            'name' => 'juliomatcom'
        ));
        $this->tryMatch('/hello/:name/age/:age','/hello/juliomatcom/age/25', array(
            'name' => 'juliomatcom',
            'age' => 25
        ));

        //with {slug}
        $this->tryMatch('/hello/{name}','/hello/juliomatcom', array(
            'name' => 'juliomatcom'
        ));
        $this->tryMatch('/hello/{name}/age/{age}','/hello/juliomatcom/age/25', array(
            'name' => 'juliomatcom',
            'age' => 25
        ));
    }

    public function  testMethod(){
        $app = new \Penobit\App();

        $func = function() {
            return true;
        };
        //default HTTP Requests in OneFramework
        $app->get('/get', $func);
        $app->post('/post', $func);
        $app->put('/put', $func);
        $app->delete('/delete', $func);

        $routes = $app->getRoutes();

        //check if routes are found
        $this->assertEquals('/get', $routes['GET'][0]->route );
        $this->assertEquals('/post', $routes['POST'][0]->route );
        $this->assertEquals('/put', $routes['PUT'][0]->route );
        $this->assertEquals('/delete', $routes['DELETE'][0]->route );
    }

    private function tryMatch($route, $uri, array $expected_slugs = array(), $expected = true ){

        $routeObj = new \Penobit\Route( $route , function ( $name ) { } );

        $uri_segments = preg_split('/[\/]+/',$uri,null,PREG_SPLIT_NO_EMPTY);

        $route_segments = preg_split('/[\/]+/',$routeObj->route,null,PREG_SPLIT_NO_EMPTY);
        $slugs = array();

        $matched = \Penobit\CoreFramework::CompareSegments($uri_segments,$route_segments,$slugs);

        //function was found
        $this->assertEquals($expected, $matched, "Cant match this route: '$route' with '$uri'\n");
        //slugs values was properly saved
        $this->assertEquals($expected_slugs, $slugs, 'Final slugs does not match');
    }

}
