<?php
namespace Yuforms\Api\Controller;

use Yuforms\Api\Core\Controller;

class LogOut extends Controller {
    protected function post() {
        if(isset($_COOKIE['jwt'])) {
            unset($_COOKIE['jwt']);
            setcookie('jwt', null, -1, '/');
        }
        $this->response([
            'state'=>'success',
            'message'=>'log out successfully'
        ]);
    }
}
