<?php
namespace Yuforms\Api\Controller;

use Yuforms\Api\Core\Controller;
use Yuforms\Api\Other\Mail;
use Yuforms\Api\Other\Random;

class ForgotMyPassword extends Controller {
    protected function post() {
        $member = \MemberQuery::create()->findOneByEmail($this->data['email']);
        if($member) {
            $this->recoveryCode = Random::recoveryCode();
            $member->setRecoveryCode($this->recoveryCode);
            $member->save();
            Mail::sendRecoveryCode($this->data['email'], $this->recoveryCode);
        }
        $this->response([
            'state'=>'success',
            'message'=>'check your email box'
        ]);
    }
    protected function patch() {
        $member = \MemberQuery::create()->filterByRecoveryCode($this->data['code'])->findOneByEmail($this->data['email']);
        if(!$member) {
            $this->responseError(401, [
                'state'=>'fail',
                'message'=>'wrong code'
            ]);
        }
        $member->setRecoveryCode(null);
        $member->setPasswordHash(password_hash($this->data['newPassword'], PASSWORD_DEFAULT));
        $member->save();
        $this->response([
            'state'=>'success',
            'message'=>'Changed password'
        ]);
    }
}
