<?php

namespace Yuforms\Api\Model;

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
}
