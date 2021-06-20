<?php
namespace Yuforms\Api\Controller;

use Yuforms\Api\Core\Controller;

class ConfirmEmail extends Controller {
    protected function post() {
        $member = \MemberQuery::create()->findOneByEmail($this->data['email']);
        if($member==null or $member->getConfirmedEmail()) {
            $this->responseError(404);
        }
        if($this->data['code']!=$member->getActivationCode()) {
            $this->responseError(401);
        }
        $member->setConfirmedEmail(true);
        $member->save();
        $this->success();
    }
}

