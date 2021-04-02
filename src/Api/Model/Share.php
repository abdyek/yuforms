<?php

namespace Yuforms\Api\Model;

class Share {
    public static function getUnfinished($formId) {
        return \ShareQuery::create()->filterByStopDateTime(null)->findOneByFormId($formId);
    }
    public static function gets($formId) {
        $shares = \ShareQuery::create()->findByFormId($formId);
        return $shares;
    }
}
