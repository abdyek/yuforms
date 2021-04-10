<?php

namespace Yuforms\Api\Model;

class Option {
    public static function getsByQuestionId($questionId) {
        return \OptionQuery::create()->findByQuestionId($questionId);
    }
    public static function deleteByQuestionId($questionId) {
        $options = self::getsByQuestionId($questionId);
        $options->delete();
    }
    public static function getsInfoArrByQuestionId($questionId) {
        $optsArr = [];
        $options = self::getsByQuestionId($questionId);
        foreach($options as $opt) {
            $optsArr[] = [
                'id'=>$opt->getId(),
                'value'=>$opt->getValue(),
                'text'=>$opt->getText()
            ];
        }
        return $optsArr;
    }
    public static function isThereValue($questionId, $value) {
        $options = self::getsByQuestionId($questionId);
        foreach($options as $opt) {
            if($opt->getValue()==$value) {
                return true;
            }
        }
        return false;
    }
    public static function create($questionId, $value, $text) {
        $option = new \Option;
        $option->setQuestionId($questionId);
        $option->setValue($value);
        $option->setText($value);
        $option->save();
        return $option;
    }
}

