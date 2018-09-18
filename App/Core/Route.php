<?php
namespace App\Core;

use App\Core\Request;

class Route
{
    public static $routes = array();
    public static $controllerNamespace = "App\\Controllers\\";

    public static function get($route, $controllerMethod){
        // saving for future reference
        self::$routes[] = $route;

        // if no params are given, it defaults to index.php. Overriding that...
        $url;
        if(!isset($_GET['url']))
            $url = 'index';
        else
            $url = $_GET['url'];
        $url = explode('/',mb_strtolower($url));

        $currentRoute = $url[0];

        // allows route span up to two levels. Everything after that is considered as parameters for controller's method
        if(count($url) > 1)
            $currentRoute .= "/".$url[1];

        if($route === $currentRoute){
            // routes with parameters always expected to be two-stepped (i.e. order/view)
            $params = array_slice($url, 2);
            $routeController = array_combine(array("controller", "method"), explode('@', $controllerMethod));
            $routeController["controller"] = self::$controllerNamespace.$routeController["controller"];
            $controller = new $routeController["controller"]();
            $controller->{$routeController["method"]}($params);
        }
    }

    public static function post($route, $controllerMethod){
        // saving for future reference
        self::$routes[] = $route;

        // if no params are given, it defaults to index.php. Overriding that...
        $url;
        if(!isset($_GET['url']))
            $url = 'index';
        else
            $url = $_GET['url'];
        $url = explode('/',mb_strtolower($url));

        $currentRoute = $url[0];

        // allows route span up to two levels. Everything after that is considered as parameters for controller's method
        if(count($url) > 1)
            $currentRoute .= "/".$url[1];

        if($route === $currentRoute){
            // getting POST params from payload
            header('Content-Type: application/json');
            header('Access-Control-Allow-Origin: *');
            $request_body = file_get_contents('php://input');

            if($request_body){
              // if POST payload exists, creates new Request object and passes it to routes controller and method
              $request = new Request($request_body);

              $routeController = array_combine(array("controller", "method"), explode('@', $controllerMethod));
              $routeController["controller"] = self::$controllerNamespace.$routeController["controller"];

              $controller = new $routeController["controller"]();
              $controller->{$routeController["method"]}($request);
            }

        }
    }
}
