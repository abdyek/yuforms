<?php

namespace Yuforms\Api\Model;

class FormItem {
    public static function gets($formId) {
        $formItems = \FormItemQuery::create()->orderByOrdinalNumber()->findByFormId($formId);
        return $formItems;
    }
    public static function get($formItemId) {
        return \FormItemQuery::create()->findPk($formItemId);
    }
    public static function getWithFormIdQuestionId($formId, $questionId) {
        return \FormItemQuery::create()->filterByFormId($formId)->filterByQuestionId($questionId)->findOne();
    }
    public static function create($formId, $questionId, $ordinalNumber) {
        $formItem = new \FormItem;
        $formItem->setFormId($formId);
        $formItem->setQuestionId($questionId);
        $formItem->setOrdinalNumber($ordinalNumber);
        $formItem->save();
        return $formItem;
    }
    public static function updateOrdinalNumber($formItem, $ordinalNumber) {
        $formItem->setOrdinalNumber($ordinalNumber);
        $formItem->save();
        return $formItem;
    }
}
