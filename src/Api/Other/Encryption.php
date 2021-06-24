<?php
namespace Yuforms\Api\Other;
use Yuforms\Api\Config\Encryption as EncryptionConfig;

class Encryption {
    public static function encryptSlug($id) {
        $hex = dechex($id);
        $string = EncryptionConfig::CONFUSER_FIRST . $hex . EncryptionConfig::CONFUSER_LAST;
        $hashedString = hash(EncryptionConfig::HASH_ALGO,$string);
        $shortHashedString = substr($hashedString, EncryptionConfig::STARTING_INDEX, EncryptionConfig::HASH_LEN);
        return $hex . $shortHashedString;
    }
    public static function checkEncryptedSlug($encSlug) {
        if(strlen($encSlug)<=EncryptionConfig::HASH_LEN) {
            return false;
        }
        $id = self::getId($encSlug);
        $hash = self::encryptSlug($id);
        return ($encSlug===$hash);
    }
    public static function getId($encSlug) {
        return hexdec(substr($encSlug, 0, strlen($encSlug)-EncryptionConfig::HASH_LEN));
    }
}
