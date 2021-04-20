<?php
namespace Yuforms\Api\Controller;

use Yuforms\Api\Core\Controller;
use Yuforms\Api\Other\Time;
use Yuforms\Api\Model\Member as MemberModel;
use Yuforms\Api\Model\Form as FormModel;
use Yuforms\Api\Model\Share as ShareModel;
use Yuforms\Api\Model\Question as QuestionModel;

class Form extends Controller {
    protected function post() {
        $this->member = MemberModel::get($this->userId);
        $this->form = FormModel::create([
            'memberId'=>$this->userId,
            'name'=>$this->data['formTitle']
        ]);
        $this->response([
            'formId'=>$this->form->getId(),
            'formSlug'=>'slug will be here'
        ]);
        FormModel::addQuestions($this->form, $this->data['questions']);
    }
    protected function get() {
        $form = FormModel::getWithMemberId($this->userId, $this->data['id']);
        if(!$form) {
            http_response_code(404);
            exit();
        }
        $this->response([
            'form'=>FormModel::getInfoArrWithShareInfo($form),
            'questions'=>QuestionModel::getsInfoArrByForm($form),
        ]);
    }
    private function checkFormAccessibility() {
        $this->form = \FormQuery::create()->findPK($this->data['id']);
        if(!$this->form) 
            return false;
        if($this->who=='guest') {
            $share = \ShareQuery::create()->filterBySessionType('all')->filterByStopDateTime(null)->filterByFormId($this->data['id'])->findOne();
            return ($share)?true:false;
        }
        if($this->who=='member') {
            $share = \ShareQuery::create()->filterBySessionType('member')->filterByStopDateTime(null)->filterByFormId($this->data['id'])->findOne();
            if($share)
                return true;
            return ($this->form->getMemberId()==$this->userId)?true:false;
        }
    }
    public function put() {
        $share = ShareModel::getUnfinished($this->data['id']);
        if($share) {
            http_response_code(422);
            exit();
        }
        $this->member = MemberModel::get($this->userId);
        $this->form = FormModel::getWithMemberId($this->userId, $this->data['id']);
        FormModel::update($this->form, $this->data);
        $this->success();
    }
    protected function delete() {
        $form = formModel::get($this->data['id']);
        if($form->getMemberId()!=$this->userId or $form->getIsTemplate()) {
            http_response_code(404);
            exit();
        }
        FormModel::delete($this->data['id']);
        $this->success();
    }
}
