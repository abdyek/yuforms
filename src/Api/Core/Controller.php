<?php
namespace Yuforms\Api\Core;
use Yuforms\Api\Core\Response;

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
        if($this->silence===false) {
            Response::data($data);
        }
    }
    public function responseError($errorCode, $data=null) {
        Response::error($errorCode, $data);
    }
    public function success() {
        $this->response(['state'=>'success']);
    }
}
