<?php
namespace Yuforms\Controller;

use Yuforms\Core\Controller;
use Yuforms\Other\Time;
use Yuforms\Other\Mail;
use Yuforms\Other\Random;

class SignUp extends Controller {
    protected function post() {
        $this->uniqueEmailCheck();
        $this->add();
        $this->sendActivationCode();
        $this->success();
    }
    private function uniqueEmailCheck() {
        $query = \MemberQuery::create()->findOneByEmail($this->data['email']);
        if($query) {
            $this->response(['error'=>'available email']);
            exit();
        }
    }
    private function add() {
        $passwordHash = password_hash($this->data['password'], PASSWORD_DEFAULT);
        $this->activationCode = Random::activationCode();
        $member = new \Member();
        $member->setEmail($this->data['email']);
        $member->setFirstName($this->data['firstName']);
        $member->setLastName($this->data['lastName']);
        $member->setConfirmedEmail(false);
        $member->setPasswordHash($passwordHash);
        $member->setActivationCode($this->activationCode);
        $member->setSignUpDateTime(Time::current());
        $member->save();
    }
    private function sendActivationCode() {
        Mail::send();
    }
}
