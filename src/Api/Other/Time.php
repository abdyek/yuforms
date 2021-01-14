<?php
namespace Yuforms\Api\Other;

class Time {
    public static function current() {
        return date('Y-m-d H:i:s', time());
    }
}
