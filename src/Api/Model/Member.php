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
}

