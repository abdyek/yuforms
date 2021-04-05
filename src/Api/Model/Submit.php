<?php

namespace Yuforms\Api\Model;

class Submit {
    public static function create($obj) {
        $submit = new \Submit();
        $submit->setFormItemId($obj['formItemId']);
        $submit->setShareId($obj['shareId']);
        $submit->setResponse($obj['response']);
        $submit->setMultiResponse($obj['multiResponse']);
        $submit->setMemberId($obj['memberId']);
        $submit->setIpAddress($obj['ipAddress']);
        $submit->save();
    }
    public static function getCountByShareIdMemberId($shareId, $memberId) {
        return \SubmitQuery::create()->filterByShareId($shareId)->filterByMemberId($memberId)->count();
    }
    public static function getCountByShareIdIpAddress($shareId, $IpAddress) {
        return \SubmitQuery::create()->filterByShareId($shareId)->filterByIpAddress($IpAddress)->count();
    }
    public static function deleteByShareId($shareId) {
        $submit = \SubmitQuery::create()->findByShareId($shareId);
        $submit->delete();
    }
    public static function deleteByShares($shares) {
        foreach($shares as $s) {
            self::deleteByShareId($s->getId());
        }
    }
    public static function deleteByFormItemId($formItemId) {
        $submit = \SubmitQuery::create()->findByFormItemId($formItemId);
        $submit->delete();
    }
    public static function deleteByFormItems($formItems) {
        foreach($formItems as $fi) {
            self::deleteByFormItemId($fi->getId());
        }
    }
}

