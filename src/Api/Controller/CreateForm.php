<?php
namespace Yuforms\Api\Controller;

use Yuforms\Api\Core\Controller;

class CreateForm extends Controller {
    protected function post() {
        $this->response([
            'formSlug'=>'formSlugResponsedBackEnd'
        ]);
    }
}
