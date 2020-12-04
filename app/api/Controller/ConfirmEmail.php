<?php
namespace Yuforms\Controller;

use Yuforms\Core\Controller;

class ConfirmEmail extends Controller {
    protected function post() {
        $member = \MemberQuery::create()->findOneByEmail($this->data['email']);
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

