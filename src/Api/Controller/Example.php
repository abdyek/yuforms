<?php

namespace Yuforms\Api\Controller;

use Yuforms\Api\Core\Controller;

class Example extends Controller {
    protected function post() {
        $this->response($this->data);
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
}
