<?php
namespace Yuforms\Controller;

use Yuforms\Core\Controller;
use Ahc\Jwt\JWT;
use Yuforms\Config\Jwt as JwtConfig;
use Yuforms\Config\Cookie as CookieConfig;

class Login extends Controller {
    protected function post() {
        $this->member = \MemberQuery::create()->filterByConfirmedEmail(true)->findOneByEmail($this->data['email']);
        if($this->member) {
            $hash = $this->member->getPasswordHash();
            if(password_verify($this->data['password'], $hash)) {
                $this->setToken($this->member->getId());
                $this->response([
                    'state'=>'success',
                    'jwt'=>$this->token,
                    'id'=>$this->member->getId(),
                    'email'=>$this->member->getEmail(),
                    'firstName'=>$this->member->getFirstName(),
                    'lastName'=>$this->member->getLastName()
                ]);
                exit();
            }
        }
        http_response_code(401);
        exit();
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
            'httponly'=>CookieConfig::HTTPONLY,
            'samesite'=>CookieConfig::SAMESITE
        ]);
    }
}
