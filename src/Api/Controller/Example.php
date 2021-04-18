<?php

namespace Yuforms\Api\Controller;

use Yuforms\Api\Core\Controller;
use Yuforms\Api\Other\Time;

class Example extends Controller {
    protected function post() {
        $this->response($this->data);
    }
    protected function get() {
        $this->response($this->data);
    }
}
