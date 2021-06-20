<?php
namespace Yuforms\Api\Controller;
use Yuforms\Api\Core\Controller;
use Yuforms\Api\Model\AuthenticationCode as AuthenticationCodeModel;
use Yuforms\Api\Model\Member as MemberModel;
use Yuforms\Api\Config\Config;

class Manage2FA extends Controller {
    protected function patch() {
        $member = MemberModel::get($this->userId);
        if(!password_verify($this->data['password'], $member->getPasswordHash())) {
            $this->responseError(401, [
                'state'=>'fail',
                'message'=>'wrong password'
            ]);
        }
        $this->generateAndSend();
        $this->success();
    }
    private function generateAndSend() {
        $auths = AuthenticationCodeModel::getsByMemberId($this->userId, 'manage2fa');
        $auths->delete();
        $code = AuthenticationCodeModel::create([
            'memberId'=>$this->userId,
            'type'=>'manage2fa'
        ]);
        // Mail::send();
        // ^ it will be changed
    }
    protected function post() {
        // I should refactor here and Login::patch, because almost same code
        $code = AuthenticationCodeModel::getByMemberId($this->userId, 'manage2fa');
        if(!$code) {
            $this->responseError(404);
        }
        $trialCount = $code->getTrialCount();
        $dateTime = $code->getDateTime();
        $timestamp = $dateTime->getTimestamp();
        if((time()-$timestamp)>Config::VALIDITY_TIME) {
            $this->responseError(401, [
                'state'=>'fail',
                'message'=>'timeout! you must request again'
            ]);
        } elseif($trialCount>=Config::VALIDATION_TRIAL_MAX_COUNT) {
            $this->responseError(401, [
                'state'=>'fail',
                'message'=>'trial count is over! you must request again'
            ]);
        } elseif($code->getCode()==$this->data['authenticationCode']) {
            $code->delete();
            $this->set2faSetting();
        } else {
            $this->responseError(401, [
                'state'=>'fail',
                'message'=>'wrong code',
            ]);
            $code->setTrialCount($trialCount+1);
            $code->save();
        }
    }
    protected function set2faSetting() {
        $member = MemberModel::get($this->userId);
        $member->setHaveTo2fa($this->data['open']);
        $member->save();
        $this->success();
    }
}
