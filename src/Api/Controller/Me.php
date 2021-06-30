<?php

namespace Yuforms\Api\Controller;
use Yuforms\Api\Core\Controller;
use Yuforms\Api\Model\Member as MemberModel;

class Me extends Controller {
    protected function get() {
        $info = null;
        if($this->who==='member') {
            $info = MemberModel::getInfoArrById($this->userId);
        }
        $this->response([
            'state'=>'success',
            'who'=>$this->who,
            'info'=>$info
        ]);
    }
}
