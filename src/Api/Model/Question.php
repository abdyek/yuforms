<?php

namespace Yuforms\Api\Model;
use Yuforms\Api\Model\FormComponent as FormComponentModel;
use Yuforms\Api\Model\Option as OptionModel;

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
                OptionModel::create($qId, $i, $opt['text']);
            }
        }
        $question->save();
    }
}
