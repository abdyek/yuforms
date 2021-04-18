<?php
namespace Yuforms\Api\Core;

class Controller {
    public function __construct($obj) {
        $this->set($obj);
        $this->run();
    }
    private function set($obj) {
        $this->method = $obj['method'];
        $this->data = $obj['data'];
        $this->who = $obj['who'];
        $this->userId = $obj['userId'];
        $this->silence = isset($obj['silence'])?$obj['silence']:false;
    }
    private function run() {
        if($this->method==='POST') {
            $this->post();
        } elseif($this->method==='GET') {
            $this->get();
        } elseif($this->method==='PUT') {
            $this->put();
        } elseif($this->method==='PATCH') {
            $this->patch();
        } elseif($this->method==='DELETE') {
            $this->delete();
        }
    }
    public function response($data) {
        if($this->silence)
            return
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        echo json_encode($data);
    }
    public function success() {
        $this->response(['state'=>'success']);
    }
}
