<?php

require 'vendor/autoload.php';
require 'generated-conf/config.php';

// website
use Yuforms\WebSite\Core\Controller as WebSiteController;
//use Yuforms\WebSite\Config as WebSiteConfig;

// router
use Buki\Router\Router;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$router = new Router;

// api
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

// website
$router->get('/', function(){
    Page::create();
});

$router->get('/:slug?', function($slug = 'index'){
    new WebSiteController($slug);
});

$router->run();
