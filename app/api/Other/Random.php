<?php
namespace Yuforms\Other;

class Random {
    public static function activationCode(){
        return (string)random_int(100000, 999999);
    }
}
