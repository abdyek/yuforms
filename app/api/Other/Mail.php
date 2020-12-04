<?php
namespace Yuforms\Other;

class Mail {
    public static function send($to, $sub, $message) {
        $headers = 'From: info@yuforms.com' . "\r\n";
        mail($to, $sub, $message, $headers);
    }
    public static function sendActivationCode($mail, $code) {
        $sub = 'Yuforms - Confirm Your Email';
        $message = 'Your email activation code is '.$code;
        self::send($mail, $sub, $message);
    }
    public static function sendRecoveryCode($mail, $code) {
        $sub = 'Yuforms - Rescue Your Account';
        $message = 'Your recovery code is ' . $code;
        self::send($mail, $sub, $message);
    }
}
