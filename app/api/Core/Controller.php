<?php
namespace Yuforms\Core;
use Yuforms\Config\Config as Config;

class Controller {
    public function __construct() {
        $this->setConfig();
        $this->detectAuthorization();
        $this->checkMethod();
        $this->checkAuthorization();
        $this->setData();
        $this->checkRequired($this->data);
    }
    private function setConfig() {
        $p = explode('\\', get_class($this));
        $this->className = end($p);
        $this->config = Config::CONTROLLER[$this->className];
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->supportedMethods = array_keys($this->config);
    }
    private function checkMethod() {
        if(!in_array($this->method, $this->supportedMethods)) {
            http_response_code(405);
            exit();
        }
        $methodArrayKeys = array_keys($this->config[$this->method]);
        $this->requiredFree = (in_array('required', $methodArrayKeys))?false:true;
    }
    private function checkAuthorization() {
        if(!in_array($this->who, $this->config[$this->method]['authorization'])) {
            http_response_code(403);
            exit();
        }
    }
    private function setData() {
        // This must be refactoring
        switch($_SERVER['REQUEST_METHOD']) {
            case 'POST':
                $this->data = (empty($_POST))?json_decode(file_get_contents('php://input'), true):$_POST;
                $this->run = function() { $this->post(); };
                break;
            case 'GET':
                $this->data = (empty($_GET))?json_decode(file_get_contents('php://input'), true):$_GET;
                $this->run = function() { $this->get(); };
                break;
            case 'PUT':
                $this->data = (empty($_PUT))?json_decode(file_get_contents('php://input'), true):$_PUT;
                $this->run = function() { $this->put(); };
                break;
            case 'PATCH':
                $this->data = (empty($_PATCH))?json_decode(file_get_contents('php://input'), true):$_PUT;
                $this->run = function() { $this->patch(); };
                break;
            case 'DELETE':
                $this->data = (empty($_DELETE))?json_decode(file_get_contents('php://input'), true):$_DELETE;
                $this->run = function() { $this->delete(); };
                break;
            default:
                break;
        }
    }
    private function checkRequired($data) {
        // not complated
        if(!$this->requiredFree) {
            $this->required = $this->config[$this->method]['required'];
            $this->response($this->required);
            $this->response($data);
        }
    }
    private function detectAuthorization() {
        // not complated
        // jwt check codes will be here
        $this->who = 'member'; // guest, member, root
        // ^ only to try 
    }
    protected function response($data) {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        echo json_encode($data);
    }
}
