<?php

namespace Yuforms\Api\Model;
use Yuforms\Api\Model\FormItem as FormItemModel;
use Yuforms\Api\Model\Member as MemberModel;

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
    public static function getByFormItemId($formItemId) {
        return \SubmitQuery::create()->findOneByFormItemId($formItemId);
    }
    public static function getsByShareIdMemberId($shareId, $memberId) {
        return \SubmitQuery::create()->filterByMemberId($memberId)->findByShareId($shareId);
    }
    public static function getsByShareIdIpAddress($shareId, $ipAddress) {
        return \SubmitQuery::create()->filterByIpAddress($ipAddress)->findByShareId($shareId);
    }
    public static function getsByShareId($shareId) {
        return \SubmitQuery::create()->findByShareId($shareId);
    }
    public static function updateSubmit($submit, $obj) {
        $submit->setResponse($obj['response']);
        $submit->setMultiResponse($obj['multiResponse']);
        $submit->save();
    }
    public static function getInfoArrWithQuestionId($submit) {
        $formItem = FormItemModel::get($submit->getFormItemId());
        return [
            'id'=>$submit->getId(),
            'questionId'=>$formItem->getQuestionId(),
            'answer'=>$submit->getResponse(),
            'multiResponse'=>$submit->getMultiResponse()
        ];
    }
    public static function getsInfoArr($submits) {
        $submitsArr = [];
        $questions = [];
        foreach($submits as $sub) {
            $arr = self::getInfoArrWithQuestionId($sub);
            if($arr['multiResponse']===true) {
                if(isset($questions[$arr['questionId']])) {
                    $questions[$arr['questionId']]['answer'] .= '-'.$arr['answer'];
                } else {
                    $questions[$arr['questionId']] = $arr;
                }
            } else {
                $submitsArr[] = $arr;
            }
        }
        foreach($questions as $que) {
            $submitsArr[] = $que;
        }
        return $submitsArr;
    }
    public static function getsInfoArrByShareIdGroupedUser($shareId) {
        $infoArr = [];
        $memberIds = self::getMemberIdsByShareId($shareId);
        $ipAddresses = self::getIpAddressesByShareId($shareId);
        foreach($memberIds as $mId) {
            $submits = self::getsByShareIdMemberId($shareId, $mId);
            $answers = self::getsInfoArr($submits);
            $infoArr[] = [
                'userType'=>'member',
                'info'=>MemberModel::getInfoArrLimitedById($mId),
                'answers'=>$answers
            ];
        }
        foreach($ipAddresses as $ipA) {
            $submits = self::getsByShareIdIpAddress($shareId, $ipA);
            $answers = self::getsInfoArr($submits);
            $infoArr[] = [
                'userType'=>'anonymous',
                'info'=>null,
                'answers'=>$answers
            ];
        }
        return $infoArr;
    }
    public static function getMemberIdsByShareId($shareId) {
        // I am going to refactor this function using with Propel critaria after
        $memberIds = [];
        $submits = self::getsByShareId($shareId);
        foreach($submits as $sub) {
            $memberId = $sub->getMemberId();
            if(in_array($memberId, $memberIds) or $memberId === null)
                continue;
            $memberIds[] = $memberId;
        }
        return $memberIds;
    }
    public static function getIpAddressesByShareId($shareId) {
        // I am going to refactor this function using with Propel critaria after
        $ipAddresses = [];
        $submits = self::getsByShareId($shareId);
        foreach($submits as $sub) {
            $ipAddress = $sub->getIpAddress();
            if(in_array($ipAddress, $ipAddresses) or $ipAddress === null) 
                continue;
            $ipAddresses[] = $ipAddress;
        }
        return $ipAddresses;
    }
}

