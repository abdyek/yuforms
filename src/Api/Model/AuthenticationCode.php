<?php
namespace Yuforms\Api\Model;
use Yuforms\Api\Other\Random;

class AuthenticationCode {
    public static function getByMemberId($memberId, $type) {
        return \AuthenticationCodeQuery::create()->filterByType($type)->findOneByMemberId($memberId);
    }
    public static function getsByMemberId($memberId, $type) {
        return \AuthenticationCodeQuery::create()->filterByType($type)->findByMemberId($memberId);
    }
    public static function create($obj) {
        $authCode = new \AuthenticationCode();
        $authCode->setMemberId($obj['memberId']);
        $authCode->setType($obj['type']);
        $authCode->setCode(Random::generateAllType($obj['type']));
        $authCode->save();
        return $authCode;
    }
}
