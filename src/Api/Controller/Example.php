<?php

namespace Yuforms\Api\Controller;

use Yuforms\Api\Core\Controller;
use Yuforms\Api\Other\Time;

class Example extends Controller {
    protected function post() {
        $this->response($this->data);
        /*
        $this->response([
            'formSlug'=>'thisIsFormSlug'
        ]);
         */
        /*
        $query = new \MemberQuery();
        $member = $query->findPK($this->userId);
        $form = new \Form();
        $form->setMember($member);
        $form->setName("Form ismi");
        $form->setCreateDateTime(Time::current());
        $form->save();
        $this->response($this->data);
         */
        /*
        $currentDateTime = date('Y-m-d H:i:s', time());
        $member = new \Member();
        $member->setEmail('yunusemrebulut123@gmail.com');
        $member->setFirstName('Yunus Emre');;
        $member->setLastName('Bulut');
        $member->setConfirmedEmail(false);
        $member->setPasswordHash('parola heşi buraya');
        $member->setSignUpDateTime($currentDateTime);
        $member->save();
         */
    }
    protected function get() {
        $this->response($this->data);
    }
}
