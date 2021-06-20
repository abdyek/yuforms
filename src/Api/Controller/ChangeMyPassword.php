<?php
namespace Yuforms\Api\Controller;

use Yuforms\Api\Core\Controller;

class ChangeMyPassword extends Controller {
    protected function patch() {
        $this->member = \MemberQuery::create()->findPK($this->userId);
        if(!password_verify($this->data['password'], $this->member->getPasswordHash())) {
            $this->responseError(401, [
                'state'=>'fail',
                'message'=>'wrong password'
            ]);
        }
        $this->member->setPasswordHash(password_hash($this->data['newPassword'], PASSWORD_DEFAULT));
        $this->member->save();
        $this->response([
            'state'=>'success',
            'message'=>'your password changed'
        ]);
    }
}
