<?php
namespace Yuforms\Api\Core;

class Response {
    public static function data($data) {
        ob_start();
        header("Access-Control-Allow-Origin: *", true);
        header("Content-Type: application/json; charset=UTF-8", true);
        ob_end_flush();
        echo json_encode($data);
    }
    public function error($errorCode, $data) {
        ob_start();
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        http_response_code($errorCode);
        ob_end_flush();
        if($data!==null)
            echo json_encode($data);
        exit();
    }
}
