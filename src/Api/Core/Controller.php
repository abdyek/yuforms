<?php
namespace Yuforms\Api\Core;

use Yuforms\Api\Config\Controller as ControllerConfig;
use Ahc\Jwt\JWT;
use Yuforms\Api\Config\Jwt as JwtConfig;

class Controller {
    public function __construct() {
        $this->setConfig();
        $autho = $this->detectAuthorization();
        $this->who = $autho['who'];
        $this->userId = $autho['userId'];
        $this->checkMethod();
        $this->checkAuthorization();
        $this->setData();
        $this->checkRequiredWrapper();
        ($this->run)();
    }
    private function setConfig() {
        $p = explode('\\', get_class($this));
        $this->className = end($p);
        $this->config = ControllerConfig::CONTROLLER[$this->className];
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
    private function checkRequiredWrapper() {
        if(!$this->requiredFree) {
            $areYouOk = $this->checkRequired($this->data, $this->config[$this->method]['required']);
            if(!$areYouOk) {
                http_response_code(400);
                exit();
            }
        }
    }
    private function checkRequired($data, $required) {
        if(!$data) return false;
        $dataKeys = array_keys($data);
        foreach($required as $key=>$value) {
            $keysInValues = array_keys($value);
            if(!in_array($key, $dataKeys)) {
                return false;
            }
            if(in_array('type', $keysInValues)) {
                if(
                    ($value['type']=='str' and is_string($data[$key])) or
                    ($value['type']=='int' and is_int($data[$key])) or
                    ($value['type']=='arr' and is_array($data[$key])) or 
                    ($value['type']=='email' and $this->emailPatternCheck($data[$key]))
                ) {
                    if(!(
                        ($value['type']=='str' and (strlen($data[$key])>=$value['limits']['min'] and strlen($data[$key])<=$value['limits']['max'])) or
                        ($value['type']=='int' and (strlen((string)$data[$key])>=$value['limits']['min'] and strlen((string)$data[$key])<=$value['limits']['max'])) or
                        ($value['type']=='arr' and (count($data[$key])>=$value['limits']['min'] and count($data[$key])<=$value['limits']['max'])) or
                        ($value['type']=='email' and (strlen($data[$key])>=$value['limits']['min'] and strlen($data[$key])<=$value['limits']['max']))
                    )) {
                        return false;
                    }
                } else {
                    return false;
                }
            } else {
                $this->checkRequired($data[$key], $required[$key]);
            }
        }
        return true;
    }
    // Used in WebSite\Core\Controller
    public function detectAuthorization() {
        if(isset($_COOKIE['jwt'])) {
            try {
                $payload = (new JWT(JwtConfig::SECRET, JwtConfig::ALGO, 1800))->decode($_COOKIE['jwt']);
            } catch(Exception $e) {
                if(isset($_COOKIE['jwt'])) {
                    unset($_COOKIE['jwt']);
                    setcookie('jwt', null, -1);
                }
            }
            if(isset($payload['userId'])) {
                return [
                    'who'=>$payload['who'],
                    'userId'=>$payload['userId']
                ];
            }
        } else {
            return [
                'who'=>'guest',
                'userId'=>null
            ];
        }
    }
    // ^ Used in WebSite\Core\Controller

    private function emailPatternCheck($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
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
