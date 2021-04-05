<?php

namespace Yuforms\Api\Controller;
use Yuforms\Api\Core\Controller;
use Yuforms\Api\Model\Member as MemberModel;
use Yuforms\Api\Model\Form as FormModel;
use Yuforms\Api\Model\Share as ShareModel;
use Yuforms\Api\Other\Time;

class Share extends Controller {
    protected function post() {
        $this->prepareModels();
        if($this->availableShare) {
            http_response_code(422);
            exit();
        }
        $this->addNewShare();
        $this->success();
    }
    private function prepareModels() {
        $this->member = MemberModel::get($this->userId);
        $this->form = FormModel::getWithMemberId($this->member->getId(), $this->data['id']);
        $this->availableShare = ShareModel::getUnfinished($this->form->getId());
    }
    private function addNewShare() {
        $share = new \Share();
        $share->setStartDateTime(Time::current());
        $share->setOnlyMember($this->data['onlyMember']);
        $share->setFormId($this->form->getId());
        $share->save();
    }
    protected function delete() {
        $this->prepareModels();
        if(!$this->availableShare) {
            http_response_code(404);
            exit();
        }
        $this->stopShare();
        $this->success();
    }
    private function stopShare() {
        $this->availableShare->setStopDateTime(Time::current());
        $this->availableShare->save();
    }
}