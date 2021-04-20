<?php
namespace Yuforms\Api\Controller;

use Yuforms\Api\Core\Controller;
use Yuforms\Api\Other\Time;
use Yuforms\Api\Model\Member as MemberModel;
use Yuforms\Api\Model\Form as FormModel;
use Yuforms\Api\Model\Share as ShareModel;

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
        $this->formOwner = false;
        if(!$this->checkFormAccessibility()) {
            http_response_code(403);
            exit();
        }
        //$this->checkOwner();
        //$this->checkShared();
        $this->response([
            'form'=>[
                'id'=>$this->form->getId(),
                'name'=>$this->form->getName(),
                'createdDateTime'=>$this->form->getLastEditDateTime(),
                'memberId'=>$this->form->getMemberId(),
                'owner'=>$this->checkOwner(),
                'sharingNow'=>$this->checkShared()
            ],
            'questions'=>$this->getQuestions()
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
    private function checkOwner() {
        return ($this->who=='member' and $this->userId==$this->form->getMemberId())?true:false;
    }
    private function checkShared() {
        $share = \ShareQuery::create()->filterByStopDateTime(null)->filterByFormId($this->data['id'])->findOne();
        return ($share)?true:false;
    }
    private function getQuestions() {
        $questions = [];
        $this->formItems = \FormItemQuery::create()->filterByFormId($this->form->getId())->find();
        foreach($this->formItems as $item) {
            $question = \QuestionQuery::create()->findPK($item->getQuestionId());
            $formComponent = \FormComponentQuery::create()->findPK($question->getFormComponentId());
            $questions[] = [
                $item->getQuestionId() => [
                    'id'=>$question->getId(),
                    'text'=>$question->getText(),
                    'formComponentType'=>$formComponent->getFormComponentName(),
                    'options'=>($formComponent->getHasOptions())?$this->getOptions($question->getId()):null
                ]
            ];
        }
        return $questions;
    }
    private function getOptions($questionId) {
        $optionsArr = [];
        $options = \OptionQuery::create()->filterByQuestionId($questionId)->find();
        foreach($options as $opt) {
            $optionsArr[] = [
                $opt->getId() => [
                    'id'=>$opt->getId(),
                    'value'=>$opt->getValue(),
                    'text'=>$opt->getText()
                ]
            ];
        }
        return $optionsArr;
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
