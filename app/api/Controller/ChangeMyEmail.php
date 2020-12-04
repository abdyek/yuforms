<?php
namespace Yuforms\Controller;

use Yuforms\Core\Controller;

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
        $this->member->setEmail($this->data['newEmail']);
        $this->member->setConfirmedEmail(false);
        $this->member->save();
        $this->response([
            'state'=>'success',
            'message'=>'your password changed'
        ]);
    }
}
