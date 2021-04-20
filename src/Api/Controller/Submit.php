<?php

namespace Yuforms\Api\Controller;
use Yuforms\Api\Core\Controller;
use Yuforms\Api\Model\Form as FormModel;
use Yuforms\Api\Model\Member as MemberModel;
use Yuforms\Api\Model\Share as ShareModel;
use Yuforms\Api\Model\FormItem as FormItemModel;
use Yuforms\Api\Model\Question as QuestionModel;
use Yuforms\Api\Model\FormComponent as FormComponentModel;
use Yuforms\Api\Model\Option as OptionModel;
use Yuforms\Api\Model\Submit as SubmitModel;

class Submit extends Controller {
    protected function get() {
        $this->prepareModels();
        $this->response([
            'form'=>[
                'title'=>$this->form->getName()
            ],
            'questions'=>$this->getQuestions()
        ]);
    }
    private function prepareModels() {
        $this->form = FormModel::get($this->data['formId']);
        $this->share = ShareModel::getUnfinished($this->form->getId());
        if(!$this->share or ($this->share->getOnlyMember() and $this->who==='guest')) {
            http_response_code(404);
            exit();
        }
    }
    private function getQuestions() {
        $quesArr = [];
        $formItems = FormItemModel::gets($this->form->getId());
        foreach($formItems as $fi) {
            $que = QuestionModel::get($fi->getQuestionId());
            $formComponent = FormComponentModel::getInfoArr($que->getFormComponentId());
            $options = ($formComponent['hasOptions'])?OptionModel::getsInfoArrByQuestionId($que->getId()):null;
            $quesArr[] = [
                'id'=>$que->getId(),
                'text'=>$que->getText(),
                'formComponent'=>$formComponent,
                'options'=>$options,
            ];
        }
        return $quesArr;
    }
    protected function post() {
        $this->prepareModels();
        if($this->checkAvailable()) {
            http_response_code(422);
            exit();
        }
        $answers = $this->data['answers'];
        foreach($answers as $ans) {
            if(!$this->add($ans)) {
                continue;
            }
        }
        $this->success();
    }
    private function checkAvailable() {
        if($this->share->getOnlyMember()) {
            return SubmitModel::getCountByShareIdMemberId($this->share->getId(), $this->userId);
        } else {
            return SubmitModel::getCountByShareIdIpAddress($this->share->getId(), $_SERVER['REMOTE_ADDR']);
        }
        return null;
    }
    private function add($ans) {
        if(!$this->prepareModelsForAnswer($ans))
            return false;
        if($this->formComponent->getMultiResponse()) {
            $values = explode('-', $ans['answer']);
            foreach($values as $val) {
                if($this->formComponent->getHasOptions()) {
                    if(!OptionModel::isThereValue($this->question->getId(), $val)) {
                        continue;
                    }
                }
                SubmitModel::create([
                    'formItemId'=>$this->formItem->getId(),
                    'shareId'=>$this->share->getId(),
                    'response'=>$val,
                    'multiResponse'=>'1',
                    'memberId'=>$this->userId,
                    'ipAddress'=>$this->ipAddress
                ]);
            }
        } else {
            SubmitModel::create([
                'formItemId'=>$this->formItem->getId(),
                'shareId'=>$this->share->getId(),
                'response'=>$ans['answer'],
                'multiResponse'=>'0',
                'memberId'=>$this->userId,
                'ipAddress'=>$this->ipAddress
            ]);
        }
    }
    private function prepareModelsForAnswer($ans) {
        $this->question = QuestionModel::get($ans['questionId']);
        if(!$this->question) {
            return false;
        }
        $this->formItem = FormItemModel::getWithFormIdQuestionId($this->form->getId(), $this->question->getId());
        $this->formComponent = FormComponentModel::get($this->question->getFormComponentId());
        if(!$this->formItem) {
            return false;
        }
        if($this->share->getOnlyMember()) {
            $this->userId = $this->userId;
            $this->ipAddress = null;
        } else {
            $this->userId = null;
            $this->ipAddress = $_SERVER['REMOTE_ADDR'];
        }
    }
    protected function put() {
        $this->prepareModels();
        if(!$this->checkAvailable()) {
            http_response_code(404);
            exit();
        }
        $answers = $this->data['answers'];
        foreach($answers as $ans) {
            if(!$this->update($ans)) {
                continue;
            }
        }
        $this->success();
    }
    protected function update($ans) {
        if($this->prepareModelsForAnswer($ans))
            return false;
        $formItemId = $this->formItem->getId();
        $submit = SubmitModel::getByFormItemId($formItemId);
        if($this->formComponent->getMultiResponse()) {
            SubmitModel::deleteByFormItemId($formItemId);
            $values = explode('-', $ans['answer']);
            foreach($values as $val) {
                SubmitModel::create([
                    'formItemId'=>$this->formItem->getId(),
                    'shareId'=>$this->share->getId(),
                    'response'=>$val,
                    'multiResponse'=>'1',
                    'memberId'=>$this->userId,
                    'ipAddress'=>$this->ipAddress
                ]);
            }
        } else {
            SubmitModel::updateSubmit($submit, [
                'response'=>$ans['answer'],
                'multiResponse'=>'0'
            ]);
        }
    }
}
