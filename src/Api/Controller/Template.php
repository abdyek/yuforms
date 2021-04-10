<?php

namespace Yuforms\Api\Controller;
use Yuforms\Api\Core\Controller;
use Yuforms\Api\Model\Template as TemplateModel;
use Yuforms\Api\Model\Form as FormModel;

class Template extends Controller {
    protected function post() {
        $form = FormModel::getWithMemberId($this->userId, $this->data['id']);
        if(!$form) {
            $template = TemplateModel::getPublic($this->data['id']);
            $form = ($template)?FormModel::get($this->data['id']):false;
        }
        if(!$form) {
            http_response_code(404);
            exit();
        }
        $template = TemplateModel::create([
            'memberId'=>$this->userId,
            'name'=>$this->data['name'],
            'isTemplate'=>true
        ]);
        TemplateModel::copyToTemplate($template, $form);
        $this->success();
    }
    protected function delete() {
        $formId = FormModel::getWithMemberId($this->userId, $this->data['id']);
        if(!$formId or !$formId->getIsTemplate()) {
            http_response_code(404);
            exit();
        }
        $template = TemplateModel::getByFormId($this->data['id']);
        TemplateModel::delete($template);
        $this->success();
    }
}
