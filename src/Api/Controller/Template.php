<?php

namespace Yuforms\Api\Controller;
use Yuforms\Api\Core\Controller;
use Yuforms\Api\Model\Template as TemplateModel;
use Yuforms\Api\Model\Form as FormModel;

class Template extends Controller {
    protected function post() {
        $form = FormModel::getWithMemberId($this->userId, $this->data['formId']);
        if(!$form) {
            $template = TemplateModel::getByFormId($this->data['formId']);
            $form = ($template->getIsPublic())?FormModel::get($this->data['formId']):false;
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
        $form = FormModel::getWithMemberId($this->userId, $this->data['formId']);
        if(!$form or !$form->getIsTemplate()) {
            http_response_code(404);
            exit();
        }
        $template = TemplateModel::getByFormId($this->data['formId']);
        TemplateModel::delete($template);
        $this->success();
    }
    protected function put() {
        $form = FormModel::getWithMemberId($this->userId, $this->data['formId']);
        if(!$form or !$form->getIsTemplate()) {
            http_response_code(404);
            exit();
        }
        FormModel::update($form, $this->data);
        $this->success();
    }
    protected function patch() {
        $form = FormModel::getWithMemberId($this->userId, $this->data['formId']);
        $template = TemplateModel::getByFormId($form->getId());
        $template->setIsPublic($this->data['public']);
        $template->save();
        $this->success();
    }
}
