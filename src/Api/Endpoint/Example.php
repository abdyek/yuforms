<?php
namespace Yuforms\Api\Endpoint;
use Yuforms\Api\Core\Endpoint;

// customable endpoint example
class Example extends Endpoint {
    protected function controllerHandler() {
        $class = 'Yuforms\Api\Controller\Example';
        new $class([
            'method'=>'DELETE',
            'data'=>[
                'this is data'=>'this is data'
            ],
            'who'=>'admin',
            'userId'=>3
        ]);
    }
}
