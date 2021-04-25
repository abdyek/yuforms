<?php
namespace Yuforms\Api\Other;
use Yuforms\Api\Config\Encryption as EncryptionConfig;

class Encryption {
    public static function encryptSlug($id) {
        $hex = dechex($id);
        $string = EncryptionConfig::CONFUSER_FIRST . $hex . EncryptionConfig::CONFUSER_LAST;
        $hashedString = hash(EncryptionConfig::HASH_ALGO,$string);
        $shortHashedString = substr($hashedString, EncryptionConfig::STARTING_INDEX, EncryptionConfig::HASH_LEN);
        return $hex . EncryptionConfig::SEPARATOR . $shortHashedString;
    }
    public static function checkEncryptedSlug($encSlug) {
        $parts = explode(EncryptionConfig::SEPARATOR, $encSlug, 2);
        if(count($parts)!==2) {
            return false;
        }
        $id = hexdec($parts[0]);
        $hash = self::encryptSlug($id);
        return ($encSlug===$hash);
    }
    public static function getId($encSlug) {
        return explode(EncryptionConfig::SEPARATOR, $encSlug, 2)[0];
    }
}
