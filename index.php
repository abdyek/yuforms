<?php

require 'vendor/autoload.php';
require 'generated-conf/config.php';

// api config
use Yuforms\Config;

// view
use Yuforms\View\Page;

// router
use Buki\Router\Router;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$router = new Router;

$router->any('api/:string', function($controller) {
    $className = ucfirst($controller);
    $filePath = __DIR__ . '/src/Api/Controller/' . $className . '.php';
    if(file_exists($filePath)) {
        $class = 'Yuforms\Api\Controller\\' . $className;
        new $class;
    } else {
        http_response_code(404);
    }
});

$router->get('/', function(){
    Page::create();
});

$router->run();
