<?php

require 'vendor/autoload.php';
require 'generated-conf/config.php';

use Yuforms\Api\Core\Endpoint;
use Yuforms\Api\Config\Config;

date_default_timezone_set(Config::TIMEZONE);

// router
use Buki\Router\Router;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$router = new Router;

// api
$router->any('api/:string', function($endpoint) {
    $endpoint = ucfirst($endpoint);
    $filePath = __DIR__ . '/src/Api/Endpoint/'.$endpoint. '.php';
    if(file_exists($filePath)) {
        $class = 'Yuforms\Api\Endpoint\\'.$endpoint;
        new $class($endpoint);
    } else {
        new Endpoint($endpoint);
    }
});

$router->run();
