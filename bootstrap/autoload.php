<?php

if (!session_id()) @session_start();
require_once __DIR__ . "/../vendor/autoload.php";

//flash message
$flash = new \Plasticbrain\FlashMessages\FlashMessages();

define("VIEWPATH" , dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR);
define("MASTERVIEW" , VIEWPATH."master.php");

//php simple route
//start
$ns = "App\\Controller\\";
$dispatcher = require_once __DIR__."/../app/routes.php";

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        $cm = explode("@" , $handler);
        $c = $ns . $cm[0];
        $m = $cm[1];
        call_user_func_array(array(new $c , $m) , $vars);
        break;
}
//end simple route