<?php
namespace Yuforms\Controller;

use Yuforms\Core\Controller;
use Ahc\Jwt\JWT;
use Yuforms\Config\Jwt as JwtConfig;

class Login extends Controller {
    protected function post() {
        echo 'login success';
    }
}
