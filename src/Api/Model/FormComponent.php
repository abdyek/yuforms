<?php

namespace Yuforms\Api\Model;

class FormComponent {
    public static function get($id) {
        return \FormComponentQuery::create()->findPk($id);
    }
    public static function getInfoArr($id) {
        $fc = self::get($id);
        return [
            'id'=>$fc->getId(),
            'title'=>$fc->getTitle(),
            'name'=>$fc->getFormComponentName(),
            'hasOptions'=>$fc->getHasOptions(),
        ];
    }
}
