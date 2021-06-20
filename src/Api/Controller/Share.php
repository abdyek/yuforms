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
            $this->responseError(422);
        }
        if($this->form->getIsTemplate()) {
            $this->responseError(404);
        }
        $this->addNewShare();
        $this->success();
    }
    private function prepareModels() {
        $this->member = MemberModel::get($this->userId);
        $this->form = FormModel::getWithMemberId($this->member->getId(), $this->data['formId']);
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
            $this->responseError(404);
        }
        $this->stopShare();
        $this->success();
    }
    private function stopShare() {
        $this->availableShare->setStopDateTime(Time::current());
        $this->availableShare->save();
    }
    protected function put() {
        new self([
            'method'=>'DELETE',
            'data'=>[
                'formId'=>$this->data['formId']
            ],
            'who'=>$this->who,
            'userId'=>$this->userId,
            'silence'=>true
        ]);
        new self([
            'method'=>'POST',
            'data'=>$this->data,
            'who'=>$this->who,
            'userId'=>$this->userId,
            'silence'=>true
        ]);
        $this->success();
    }
}
