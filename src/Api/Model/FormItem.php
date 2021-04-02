<?php

namespace Yuforms\Api\Model;

class FormItem {
    public static function gets($formId) {
        $formItems = \FormItemQuery::create()->findByFormId($formId);
        return $formItems;
    }
}
