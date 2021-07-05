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
    public static function getInfoArr($share) {
        return [
            'id'=>$share->getId(),
            'startDateTime'=>$share->getStartDateTime(),
            'stopDateTime'=>$share->getStopDateTime(),
            'onlyMember'=>$share->getOnlyMember(),
            'submitCount'=>$share->getSubmitCount()
        ];
    }
    public static function getsInfoArrByForm($form) {
        $sharesArr = [];
        $shares = \ShareQuery::create()->orderByStartDateTime('desc')->findByFormId($form->getId());
        foreach($shares as $share) {
            $sharesArr[] = self::getInfoArr($share);
        }
        return $sharesArr;
    }
    public static function get($id) {
        return \ShareQuery::create()->findPk($id);
    }
}
