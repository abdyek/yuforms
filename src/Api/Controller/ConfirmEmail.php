<?php
namespace Yuforms\Api\Controller;

use Yuforms\Api\Core\Controller;

class ConfirmEmail extends Controller {
    protected function post() {
        $member = \MemberQuery::create()->findOneByEmail($this->data['email']);
        if($member==null or $member->getConfirmedEmail()) {
            http_response_code(404);
            exit();
        }
        if($this->data['code']!=$member->getActivationCode()) {
            http_response_code(401);
            exit();
        }
        $member->setConfirmedEmail(true);
        $member->save();
        $this->success();
    }
}

