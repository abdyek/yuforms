<?php
namespace Yuforms\Other;

class Time {
    public static function current() {
        return date('Y-m-d H:i:s', time());
    }
}
