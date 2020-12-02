<?php

require 'vendor/autoload.php';
require 'generated-conf/config.php';

// api config
use Yuforms\Config;

// router
use Buki\Router\Router;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$router = new Router;

$router->any('api/:string', function($controller) {
    $className = ucfirst($controller);
    $filePath = __DIR__ . '/app/api/Controller/' . $className . '.php';
    if(file_exists($filePath)) {
        $class = 'Yuforms\Controller\\' . $className;
        new $class;
    } else {
        http_response_code(404);
    }
});

$router->run();
