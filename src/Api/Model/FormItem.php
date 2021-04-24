<?php

namespace Yuforms\Api\Model;

class FormItem {
    public static function gets($formId) {
        $formItems = \FormItemQuery::create()->findByFormId($formId);
        return $formItems;
    }
    public static function get($formItemId) {
        return \FormItemQuery::create()->findPk($formItemId);
    }
    public static function getWithFormIdQuestionId($formId, $questionId) {
        return \FormItemQuery::create()->filterByFormId($formId)->filterByQuestionId($questionId)->findOne();
    }
    public static function create($formId, $questionId) {
        $formItem = new \FormItem;
        $formItem->setFormId($formId);
        $formItem->setQuestionId($questionId);
        $formItem->save();
        return $formItem;
    }
}
