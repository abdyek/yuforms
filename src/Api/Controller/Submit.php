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
use Yuforms\Api\Other\Encryption;

class Submit extends Controller {
    protected function get() {
        $this->checkSlug();
        $this->prepareModels();
        $submits = ($this->who==='guest')?SubmitModel::getsByShareIdIpAddress($this->share->getId(), $_SERVER['REMOTE_ADDR']):SubmitModel::getsByShareIdMemberId($this->share->getId(), $this->userId);
        $this->response([
            'form'=>FormModel::getInfoArrWithShareInfo($this->form),
            'questions'=>QuestionModel::getsInfoArrByForm($this->form),
            'submitted'=>($submits->count())?true:false,
            'submit'=>SubmitModel::getsInfoArr($submits)
        ]);
    }
    private function checkSlug() {
        if(!Encryption::checkEncryptedSlug($this->data['formSlug'])) {
            $this->responseError(404);
        }
    }
    private function prepareModels() {
        $formId = Encryption::getId($this->data['formSlug']);
        $this->form = FormModel::get($formId);
        $this->share = ShareModel::getUnfinished($this->form->getId());
        if(!$this->share or ($this->share->getOnlyMember() and $this->who==='guest')) {
            $this->responseError(404);
        }
    }
    protected function post() {
        $this->checkSlug();
        $this->prepareModels();
        if($this->checkAvailable()) {
            $this->responseError(422);
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
        if($this->who==='member') {
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
                    'memberId'=>($this->who==='member')?$this->userId:null,
                    'ipAddress'=>($this->who==='guest')?$_SERVER['REMOTE_ADDR']:null
                ]);
            }
        } else {
            SubmitModel::create([
                'formItemId'=>$this->formItem->getId(),
                'shareId'=>$this->share->getId(),
                'response'=>$ans['answer'],
                'multiResponse'=>'0',
                'memberId'=>($this->who==='member')?$this->userId:null,
                'ipAddress'=>($this->who==='guest')?$_SERVER['REMOTE_ADDR']:null
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
        return true;
    }
    protected function put() {
        $this->checkSlug();
        $this->prepareModels();
        if(!$this->checkAvailable()) {
            $this->responseError(404);
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
        if(!$this->prepareModelsForAnswer($ans))
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
                    'memberId'=>($this->who==='member')?$this->userId:null,
                    'ipAddress'=>($this->who==='guest')?$_SERVER['REMOTE_ADDR']:null
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
