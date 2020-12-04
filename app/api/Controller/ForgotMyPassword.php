<?php
namespace Yuforms\Controller;

use Yuforms\Core\Controller;
use Yuforms\Other\Mail;
use Yuforms\Other\Random;

class ForgotMyPassword extends Controller {
    protected function post() {
        $member = \MemberQuery::create()->findOneByEmail($this->data['email']);
        if($member) {
            $this->recoveryCode = Random::recoveryCode();
            $member->setRecoveryCode($this->recoveryCode);
            $member->save();
            Mail::send();
        }
        $this->response([
            'state'=>'success',
            'message'=>'check your email box'
        ]);
    }
    protected function patch() {
        $member = \MemberQuery::create()->filterByRecoveryCode($this->data['code'])->findOneByEmail($this->data['email']);
        if(!$member) {
            http_response_code(403);
            $this->response([
                'state'=>'fail',
                'message'=>'wrong code'
            ]);
            exit();
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
