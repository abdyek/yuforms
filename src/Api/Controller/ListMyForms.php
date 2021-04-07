<?php

namespace Yuforms\Api\Controller;
use Yuforms\Api\Core\Controller;
use Yuforms\Api\Model\Form as FormModel;

class ListMyForms extends Controller {
    protected function get() {
        $myFormsArr = [];
        $myForms = FormModel::getsByMemberId($this->userId);
        foreach($myForms as $form) {
            $myFormsArr[] = FormModel::getInfoArrWithShareInfo($form);
        }
        $this->response([
            'myForms'=>$myFormsArr
        ]);
    }
}
