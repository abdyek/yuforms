<?php

namespace Yuforms\Api\Model;

class FormItem {
    public static function gets($formId) {
        $formItems = \FormItemQuery::create()->findByFormId($formId);
        return $formItems;
    }
    public static function getWithFormIdQuestionId($formId, $questionId) {
        return \FormItemQuery::create()->filterByFormId($formId)->filterByQuestionId($questionId)->findOne();
    }
}
