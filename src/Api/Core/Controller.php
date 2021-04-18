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
    protected function response($data) {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        echo json_encode($data);
    }
    protected function success() {
        $this->response(['state'=>'success']);
    }
}
