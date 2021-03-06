<?php

namespace Yuforms\Api\Controller;
use Yuforms\Api\Core\Controller;
use Yuforms\Api\Model\Template as TemplateModel;
use Yuforms\Api\Model\Form as FormModel;
use Yuforms\Api\Model\Question as QuestionModel;
use Yuforms\Api\Other\Encryption;

class Template extends Controller {
    protected function post() {
        $form = FormModel::getWithMemberId($this->userId, $this->data['formId']);
        if(!$form) {
            $template = TemplateModel::getByFormId($this->data['formId']);
            $form = ($template->getIsPublic())?FormModel::get($this->data['formId']):false;
        }
        if(!$form) {
            $this->responseError(404);
        }
        $template = TemplateModel::create([
            'memberId'=>$this->userId,
            'name'=>$this->data['name'],
            'isTemplate'=>true
        ]);
        TemplateModel::copyToTemplate($template, $form);
        $this->response([
            'state'=>'success',
            'id'=>$template->getId(),
            'formId'=>$template->getFormId(),
            'formSlug'=>Encryption::encryptSlug($template->getFormId())
            // ^ I am not sure it should be here
        ]);
    }
    protected function delete() {
        $form = FormModel::getWithMemberId($this->userId, $this->data['formId']);
        if(!$form or !$form->getIsTemplate()) {
            $this->responseError(404);
        }
        $template = TemplateModel::getByFormId($this->data['formId']);
        TemplateModel::delete($template);
        $this->success();
    }
    protected function put() {
        $form = FormModel::getWithMemberId($this->userId, $this->data['formId']);
        if(!$form or !$form->getIsTemplate()) {
            $this->responseError(404);
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
    protected function get() {
        $form = FormModel::getWithMemberId($this->userId, $this->data['formId']);
        if(!$form) {
            $template = TemplateModel::getByFormId($this->data['formId']);
            if($template and $template->getIsPublic()) {
                $form = FormModel::get($this->data['formId']);
            }
        }
        if(!$form or !$form->getIsTemplate()) {
            $this->responseError(404);
        }
        $this->response([
            'form'=>FormModel::getInfoArrWithShareInfo($form),
            'questions'=>QuestionModel::getsInfoArrByForm($form)
        ]);
    }
}
