<?php
namespace Yuforms\Api\Controller;

use Yuforms\Api\Core\Controller;
use Yuforms\Api\Other\Mail;
use Yuforms\Api\Other\Random;
use Yuforms\Api\Controller\LogOut;

class ChangeMyEmail extends Controller {
    protected function patch() {
        $this->member = \MemberQuery::create()->findPK($this->userId);
        if(!password_verify($this->data['password'], $this->member->getPasswordHash())) {
            $this->responseError(401, [
                'state'=>'fail',
                'message'=>'wrong password'
            ]);
        }
        $query = \MemberQuery::create()->findOneByEmail($this->data['newEmail']);
        if($query) {
            $this->responseError(422, [
                'state'=>'fail',
                'message'=>'This mail is already registered'
            ]);
        }
        $this->activationCode = Random::activationCode();
        $this->member->setEmail($this->data['newEmail']);
        $this->member->setConfirmedEmail(false);
        $this->member->setActivationCode($this->activationCode);
        $this->member->save();
        Mail::sendActivationCode($this->data['newEmail'], $this->activationCode);
        new LogOut([
            'method'=>'POST',
            'data'=>[],
            'who'=>$this->who,
            'userId'=>$this->userId,
            'silence'=>true
        ]);
        $this->response([
            'state'=>'success',
            'message'=>'your email changed'
        ]);
    }
}
