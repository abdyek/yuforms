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
        $this->form = FormModel::get($this->data['id']);
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
        $this->checkAvailable();
        $answers = $this->data['answers'];
        foreach($answers as $ans) {
            $question = QuestionModel::get($ans['questionId']);
            if(!$question) {
                continue;
            }
            $formItem = FormItemModel::getWithFormIdQuestionId($this->form->getId(), $question->getId());
            $formComponent = FormComponentModel::get($question->getFormComponentId());
            if(!$formItem) {
                continue;
            }
            if($formComponent->getHasOptions()) {
                if(!OptionModel::isThereValue($question->getId(), $ans['answer'])) {
                    continue;
                }
            }
            if($this->share->getOnlyMember()) {
                $userId = $this->userId;
                $ipAddress = null;
            } else {
                $userId = null;
                $ipAddress = $_SERVER['REMOTE_ADDR'];
            }
            SubmitModel::create([
                'formItemId'=>$formItem->getId(),
                'shareId'=>$this->share->getId(),
                'response'=>$ans['answer'],
                'multiResponse'=>$formComponent->getHasOptions(),
                'memberId'=>$userId,
                'ipAddress'=>$ipAddress
            ]);
        }
        $this->success();
    }
    private function checkAvailable() {
        $submits = null;
        if($this->share->getOnlyMember()) {
            $submits = SubmitModel::getCountByShareIdMemberId($this->share->getId(), $this->userId);
        } else {
            $submits = SubmitModel::getCountByShareIdIpAddress($this->share->getId(), $_SERVER['REMOTE_ADDR']);
        }
        if($submits) {
            http_response_code(422);
            exit();
        }
    }
}
