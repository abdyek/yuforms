<?php
namespace Yuforms\Api\Controller;

use Yuforms\Api\Core\Controller;
use Yuforms\Api\Other\Mail;
use Yuforms\Api\Other\Random;

class ChangeMyEmail extends Controller {
    protected function patch() {
        $this->member = \MemberQuery::create()->findPK($this->userId);
        if(!password_verify($this->data['password'], $this->member->getPasswordHash())) {
            http_response_code(401);
            $this->response([
                'state'=>'fail',
                'message'=>'wrong password'
            ]);
            exit();
        }
        $query = \MemberQuery::create()->findOneByEmail($this->data['newEmail']);
        if($query) {
            http_response_code(422);
            $this->response([
                'state'=>'fail',
                'message'=>'This mail is already registered'
            ]);
            exit();
        }
        $this->activationCode = Random::activationCode();
        $this->member->setEmail($this->data['newEmail']);
        $this->member->setConfirmedEmail(false);
        $this->member->setActivationCode($this->activationCode);
        $this->member->save();
        Mail::sendActivationCode($this->data['newEmail'], $this->activationCode);
        $this->response([
            'state'=>'success',
            'message'=>'your email changed'
        ]);
    }
}
