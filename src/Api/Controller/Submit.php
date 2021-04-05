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

class Submit extends Controller {
    protected function get() {
        $this->form = FormModel::get($this->data['id']);
        $share = ShareModel::getUnfinished($this->form->getId());
        if(!$share or ($share->getOnlyMember() and $this->who==='guest')) {
            http_response_code(404);
            exit();
        }
        $this->response([
            'form'=>[
                'title'=>$this->form->getName()
            ],
            'questions'=>$this->getQuestions()
        ]);
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
}
