<?php
namespace Yuforms\Controller;

use Yuforms\Core\Controller;

class ChangeMyPassword extends Controller {
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
        $this->member->setPasswordHash(password_hash($this->data['newPassword'], PASSWORD_DEFAULT));
        $this->member->save();
        $this->response([
            'state'=>'success',
            'message'=>'your password changed'
        ]);
    }
}
