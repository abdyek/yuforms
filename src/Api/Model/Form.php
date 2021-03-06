<?php

namespace Yuforms\Api\Model;
use Yuforms\Api\Model\Share as ShareModel;
use Yuforms\Api\Model\Question as QuestionModel;
use Yuforms\Api\Model\Option as OptionModel;
use Yuforms\Api\Model\FormItem as FormItemModel;
use Yuforms\Api\Model\Submit as SubmitModel;
use Yuforms\Api\Model\FormComponent as FormComponentModel;
use Yuforms\Api\Other\Time;
use Yuforms\Api\Other\Encryption;

class Form {
    public static function getWithMemberId($memberId, $formId) {
        // ^^ I will change it after as 'getByMemberId'
        $formQuery = new \FormQuery();
        $form = $formQuery->filterByMemberId($memberId)->findPk($formId);
        if(!$form) {
            http_response_code(404);
            exit();
        }
        return $form;
    }
    public static function get($formId) {
        $form = \FormQuery::create()->findPk($formId);
        if(!$form) {
            http_response_code(404);
            exit();
        }
        return $form;
    }
    public static function delete($formId) {
        $form = self::get($formId);
        $shares = ShareModel::gets($form->getId());
        $formItems = FormItemModel::gets($form->getId());
        SubmitModel::deleteByShares($shares);
        SubmitModel::deleteByFormItems($formItems);
        $shares->delete();
        $formItems->delete();
        $form->delete();
        foreach($formItems as $formItem) {
            OptionModel::deleteByQuestionId($formItem->getQuestionId());
            QuestionModel::delete($formItem->getQuestionId());
        }
    }
    public static function getsByMemberId($memberId) {
        return \FormQuery::create()->filterByIsTemplate(false)->findByMemberId($memberId);
    }
    public static function getInfoArrWithShareInfo($form) {
        $share = ShareModel::getUnfinished($form->getId());
        $shareArr = ($share)?ShareModel::getInfoArr($share):null;
        return [
            'id'=>$form->getId(),
            'slug'=>Encryption::encryptSlug($form->getId()),
            'name'=>$form->getName(),
            'createDateTime'=>$form->getCreateDateTime(),
            'lastEditDateTime'=>$form->getLastEditDateTime(),
            'stillShared'=>($share)?true:false,
            'share'=>$shareArr
        ];
    }
    public static function create($obj) {
        $isTemplate = (isset($obj['isTemplate']) and $obj['isTemplate'])?$obj['isTemplate']:false;
        $form = new \Form();
        $form->setMemberId($obj['memberId']);
        $form->setName($obj['name']);
        $form->setIsTemplate($isTemplate);
        $form->save();
        return $form;
    }
    public static function update($form, $obj) {
        $form->setName($obj['formTitle']);
        $form->setLastEditDateTime(Time::current());
        QuestionModel::updateAll($form, $obj['questions']);
        $form->save();
    }
    public static function addQuestions($form, $questions) {
        foreach($questions as $i=>$que) {
            $formComponent = FormComponentModel::getByName($que['formComponentType']);
            if(!$formComponent) {
                continue;
            }
            $question = QuestionModel::create($formComponent->getId(), $que['questionText']);
            FormItemModel::create($form->getId(), $question->getId(), $i);
            if($formComponent->getHasOptions()) {
                foreach($que['options'] as $i=>$opt) {
                    OptionModel::create($question->getId(), $opt['value'], $i);
                }
            }
        }
    }
}
