<?php
namespace Yuforms\Api\Controller;

use Yuforms\Api\Core\Controller;
use Ahc\Jwt\JWT;
use Yuforms\Api\Config\Jwt as JwtConfig;
use Yuforms\Api\Config\Cookie as CookieConfig;

class Login extends Controller {
    protected function post() {
        $this->member = \MemberQuery::create()/*->filterByConfirmedEmail(true)*/->findOneByEmail($this->data['email']);
        if($this->member==null) {
            http_response_code(401);
            exit();
        }
        $hash = $this->member->getPasswordHash();
        if(password_verify($this->data['password'], $hash)) {
            if($this->member->getConfirmedEmail()) {
                $this->setToken($this->member->getId());
                $this->response([
                    'state'=>'success',
                    'jwt'=>$this->token,
                    'id'=>$this->member->getId(),
                    'email'=>$this->member->getEmail(),
                    'firstName'=>$this->member->getFirstName(),
                    'lastName'=>$this->member->getLastName()
                ]);
            } else {
                $this->response([
                    'state'=>'fail',
                    'message'=>'email not verified'
                ]);
            }
        } else {
            http_response_code(401);
        }
    }
    private function setToken($userId) {
        $jwt = new JWT(JwtConfig::SECRET, JwtConfig::ALGO, JwtConfig::EXP);
        $this->token = $jwt->encode([
            'userId'=>$userId,
            'aud'=>JwtConfig::AUD,
            'who'=>'member',
            'iss'=>JwtConfig::ISS
        ]);
        setCookie('jwt', $this->token, [
            'secure'=>CookieConfig::SECURE,
            'path'=>'/',
            'expires'=>time() + JwtConfig::EXP,
            'httponly'=>CookieConfig::HTTPONLY,
            'samesite'=>CookieConfig::SAMESITE
        ]);
    }
}
