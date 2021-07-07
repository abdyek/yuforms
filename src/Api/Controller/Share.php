<?php

namespace Yuforms\Api\Controller;
use Yuforms\Api\Core\Controller;
use Yuforms\Api\Model\Member as MemberModel;
use Yuforms\Api\Model\Form as FormModel;
use Yuforms\Api\Model\Share as ShareModel;
use Yuforms\Api\Model\Submit as SubmitModel;
use Yuforms\Api\Other\Time;

class Share extends Controller {
    protected function get() {
        $share = ShareModel::get($this->data['id']);
        if(!$share) {
            $this->responseError(404);
        }
        $form = FormModel::get($share->getFormId());
        if(!$form) {
            $this->responseError(404);
        }
        if($this->userId!==$form->getMemberId()) {
            $this->responseError(404);
        }
        $submits = SubmitModel::getsByShareId($share->getId());
        $this->response([
            'state'=>'success',
            'share'=>ShareModel::getInfoArr($share),
            'answers'=>SubmitModel::getsInfoArrByShareIdGroupedUser($share->getId())
        ]);
    }
    protected function post() {
        $this->prepareModels();
        if($this->availableShare) {
            $this->responseError(422);
        }
        if($this->form->getIsTemplate()) {
            $this->responseError(404);
        }
        $newShare = $this->addNewShare();
        $this->response([
            'state'=>'success',
            'stillShared'=>true,
            'share'=>ShareModel::getInfoArr($newShare)
        ]);
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
        return $share;
    }
    protected function delete() {
        $this->prepareModels();
        if(!$this->availableShare) {
            $this->responseError(404);
        }
        $this->stopShare();
        $this->response([
            'state'=>'success',
            'stillShared'=>false,
            'share'=>null
        ]);
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
