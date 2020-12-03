<?php
namespace Yuforms\Controller;

use Yuforms\Core\Controller;

class ConfirmEmail extends Controller {
    protected function post() {
        $userID = 1; // it will come in JWT
        $member = \MemberQuery::create()->findPK($userID);
        if($member->getConfirmedEmail()) {
            http_response_code(403);
            exit();
        }
        if($this->data['code']!=$member->getActivationCode()) {
            http_response_code(403);
            $this->response('wrong code');
            exit();
        }
        $member->setConfirmedEmail(true);
        $member->save();
        $this->success();
    }
}

