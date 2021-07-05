<?php

namespace Yuforms\Api\Model;

class Member {
    public static function get($memberId) {
        $member = \MemberQuery::create()->findPK($memberId);
        if(!$member) {
            http_response_code(404);
            exit();
        }
        return $member;
    }
    public static function getByEmail($email) {
        return \MemberQuery::create()->findOneByEmail($email);
    }
    public static function getInfoArrById($memberId) {
        $member = self::get($memberId);
        return [
            'id'=>$member->getId(),
            'email'=>$member->getEmail(),
            'firstName'=>$member->getFirstName(),
            'lastName'=>$member->getLastName(),
            'confirmedEmail'=>$member->getConfirmedEmail(),
            'haveTo2fa'=>$member->getHaveTo2fa()
        ];
    }
    public static function getInfoArrLimitedById($memberId) {
        $memberArr = self::getInfoArrById($memberId);
        $memberArr['confirmedEmail'] = null;
        $memberArr['haveTo2fa'] = null;
        return $memberArr;
    }
}

