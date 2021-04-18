<?php
namespace Yuforms\Api\Controller;

use Yuforms\Api\Core\Controller;
use Ahc\Jwt\JWT;
use Yuforms\Api\Config\Jwt as JwtConfig;
use Yuforms\Api\Config\Cookie as CookieConfig;
use Yuforms\Api\Model\AuthenticationCode as AuthenticationCodeModel;
use Yuforms\Api\Model\Member as MemberModel;
use Yuforms\Api\Config\Config;

class Login extends Controller {
    protected function post() {
        $this->member = \MemberQuery::create()/*->filterByConfirmedEmail(true)*/->findOneByEmail($this->data['email']);
        if($this->member==null) {
            http_response_code(401);
            exit();
        }
        $this->tryToLogin();
    }
    private function tryToLogin() {
        $hash = $this->member->getPasswordHash();
        if(password_verify($this->data['password'], $hash)) {
            if($this->member->getConfirmedEmail()) {
                if($this->member->getHaveTo2fa()) {
                    $this->manageToAdd2fa();
                    $this->response([
                        'state'=>'2fa',
                        'message'=>'You have to verify authentication!'
                    ]);
                } else {
                    $this->login();
                }
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
    private function manageToAdd2fa() {
        $auths = AuthenticationCodeModel::getsByMemberId($this->member->getId(), '2fa');
        $auths->delete();
        AuthenticationCodeModel::create([
            'memberId'=>$this->member->getId(),
            'type'=>'2fa'
        ]);
    }
    private function login() {
        $this->setToken($this->member->getId());
        $this->response([
            'state'=>'success',
            'jwt'=>$this->token,
            'id'=>$this->member->getId(),
            'email'=>$this->member->getEmail(),
            'firstName'=>$this->member->getFirstName(),
            'lastName'=>$this->member->getLastName()
        ]);
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
    protected function patch() {
        $this->member = MemberModel::getByEmail($this->data['email']);
        if(!$this->member) {
            http_response_code(404);
            exit();
        }
        $authCode = AuthenticationCodeModel::getByMemberId($this->member->getId(), '2fa');
        if(!$authCode) {
            http_response_code(404);
            exit();
        }
        $trialCount = $authCode->getTrialCount();
        $dateTime = $authCode->getDateTime();
        $timestamp = $dateTime->getTimestamp();
        if((time()-$timestamp)>Config::_2FA_VALIDITY_TIME) {
            http_response_code(401);
            $this->response([
                'state'=>'fail',
                'message'=>'timeout! you must login again'
            ]);
            $authCode->delete();
        } elseif($trialCount>=Config::_2FA_TRIAL_MAX_COUNT) {
            http_response_code(401);
            $this->response([
                'state'=>'fail',
                'message'=>'trial count is over! you must login again',
            ]);
            $authCode->delete();
        } elseif($authCode->getCode()==$this->data['authenticationCode']) {
            $authCode->delete();
            $this->login();
        } else {
            http_response_code(401);
            $this->response([
                'state'=>'fail',
                'message'=>'wrong code',
            ]);
            $authCode->setTrialCount($trialCount+1);
            $authCode->save();
        }
    }
}
