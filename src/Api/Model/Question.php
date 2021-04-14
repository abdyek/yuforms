<?php

namespace Yuforms\Api\Model;
use Yuforms\Api\Model\FormComponent as FormComponentModel;
use Yuforms\Api\Model\Option as OptionModel;
use Yuforms\Api\Model\FormItem as FormItemModel;
use Yuforms\Api\Model\Submit as SubmitModel;

class Question {
    public static function get($id) {
        return \QuestionQuery::create()->findPk($id);
    }
    public static function delete($id) {
        $question = self::get($id);
        if(!$question) {
            http_response_code(404);
            exit();
        }
        $question->delete();
    }
    public static function create($formComponentId, $text) {
        $question = new \Question;
        $question->setFormComponentId($formComponentId);
        $question->setText($text);
        $question->save();
        return $question;
    }
    public static function update($question, $obj) {
        $question->setText($obj['questionText']);
        $formComponent = FormComponentModel::get($question->getFormComponentId());
        if($formComponent->getHasOptions()) {
            $qId = $question->getId();
            OptionModel::deleteByQuestionId($qId);
            foreach($obj['options'] as $i=>$opt) {
                OptionModel::create($qId, $i, $opt['value']);
            }
        }
        $question->save();
    }
    public static function updateAll($form, $obj) {
        $dontDelete = [];
        foreach($obj as $que) {
            if(!isset($que['id']) and isset($que['new'])) {
                // adding new questions
                $formComponent = FormComponentModel::getByName($que['formComponentType']);
                if(!$formComponent) {
                    continue;
                }
                $newQuestion = self::create($formComponent->getId(), $que['questionText']);
                $formItem = FormItemModel::create($form->getId(), $newQuestion->getId());
                if($formComponent->getHasOptions()) {
                    $options = $que['options'];
                    foreach($options as $i=>$opt) {
                        OptionModel::create($newQuestion->getId(), $i, $opt['value']);
                    }
                }
                $dontDelete[] = $newQuestion->getId();
            } else {
                $formItem = FormItemModel::getWithFormIdQuestionId($form->getId(), $que['id']);
                if(!$formItem) {
                    continue;
                }
                $dontDelete[] = $que['id'];
                $question = self::get($que['id']);
                self::update($question, $que);
            }
        }
        $formItems = FormItemModel::gets($form->getId());
        foreach($formItems as $fi) {
            $queId = $fi->getQuestionId();
            if(!in_array($queId, $dontDelete)) {
                $fi->delete();
                SubmitModel::deleteByFormItemId($fi->getId());
                OptionModel::deleteByQuestionId($queId);
                self::delete($queId);
            }
        }
    }
}
