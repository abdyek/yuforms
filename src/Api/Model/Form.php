<?php

namespace Yuforms\Api\Model;

class Form {
    public static function get($memberId, $formId) {
        $formQuery = new \FormQuery();
        $form = $formQuery->filterByMemberId($memberId)->findPk($formId);
        if(!$form) {
            http_response_code(404);
            exit();
        }
        return $form;
    }
}
