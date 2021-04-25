<?php
namespace Yuforms\Api\Other;

class Random {
    private static $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    public static function activationCode(){
        return (string)random_int(100000, 999999);
    }
    public static function recoveryCode() {
        $code = '';
        $len = strlen(self::$chars);
        for($i=0;$i<10;$i++) {
            $code .= self::$chars[random_int(0, $len-1)];
        }
        return $code;
    }
    public static function generateAllType($type=null) {
        if($type==='2fa') {
            return self::activationCode();
        } else {
            return self::recoveryCode();
        }
    }
}
