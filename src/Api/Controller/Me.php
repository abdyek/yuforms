<?php

namespace Yuforms\Api\Controller;
use Yuforms\Api\Core\Controller;

class Me extends Controller {
    protected function get() {
        $this->response([
            'state'=>'success',
            'who'=>$this->who
        ]);
    }
}
