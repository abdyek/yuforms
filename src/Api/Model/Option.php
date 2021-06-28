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
    public static function create($questionId, $text, $ordinalNumber) {
        $option = new \Option;
        $option->setQuestionId($questionId);
        $option->setText($text);
        $option->setOrdinalNumber($ordinalNumber);
        $option->save();
        return $option;
    }
    public static function get($optionId) {
        return \OptionQuery::create()->findPk($optionId);
    }
    public static function hasQuestion($questionId, $optionId):bool {
        $option = self::get($optionId);
        return ($option->getQuestionId()===$questionId)?true:false;
    }
    public static function updateAll($questionId, $newOptions) {
        $dontDelete = [];
        for($i=0;$i<count($newOptions);$i++) {
            $newOpt = $newOptions[$i];
            if(isset($newOpt['id']) and self::hasQuestion($questionId, $newOpt['id'])) {
                self::update($newOpt['id'], $newOpt['value'], $i);
                $dontDelete[] = $newOpt['id'];
            } elseif(!isset($newOpt['id'])) {
                $new = self::create($questionId, $newOpt['value'], $i);
                $dontDelete[] = $new->getId();
            } else {
                continue;
            }
        }
        $options = self::getsByQuestionId($questionId);
        foreach($options as $opt) {
            $id = $opt->getId();
            if(!in_array($id, $dontDelete)) {
                $opt->delete();
            }
        }
    }
    public static function update($optionId, $text, $ordinalNumber) {
        $option = self::get($optionId);
        $option->setText($text);
        $option->setOrdinalNumber($ordinalNumber);
        $option->save();
        return $option;
    }
}

