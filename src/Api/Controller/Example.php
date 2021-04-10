<?php

namespace Yuforms\Api\Controller;

use Yuforms\Api\Core\Controller;
use Yuforms\Api\Other\Time;

class Example extends Controller {
    protected function post() {
        $formComponent = new \FormComponent();
        $formComponent->setTitle('Mahmut');
        $formComponent->setFormComponentName('mahmut');
        $formComponent->save();
        echo $formComponent->getId();
    }
    protected function get() {
        $this->response($this->data);
    }
}
