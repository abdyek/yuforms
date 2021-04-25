<?php

namespace Yuforms\Api\Model;
use Yuforms\Api\Model\Form as FormModel;
use Yuforms\Api\Model\FormItem as FormItemModel;
use Yuforms\Api\Model\Question as QuestionModel;
use Yuforms\Api\Model\Option as OptionModel;

class Template {
    public static function get($id) {
        return \TemplateQuery::create()->findPk($id);
    }
    public static function getPublic($id) {
        return \TemplateQuery::create()->filterByIsPublic(true)->findPk($id);
    }
    public static function getByFormId($formId) {
        return \TemplateQuery::create()->findOneByFormId($formId);
    }
    public static function create($obj) {
        $form = FormModel::create([
            'memberId'=>$obj['memberId'],
            'name'=>$obj['name'],
            'isTemplate'=>$obj['isTemplate']
        ]);
        $template = new \Template();
        $template->setFormId($form->getId());
        $template->save();
        return $template;
    }
    public static function copyToTemplate($template, $form) {        
        $formItems = FormItemModel::gets($form->getId());
        foreach($formItems as $i=>$fi) {
            $question = QuestionModel::get($fi->getQuestionId());
            $newQuestion = QuestionModel::create($question->getFormComponentId(), $question->getText());
            FormItemModel::create($template->getFormId(), $newQuestion->getId(), $i);
            $options = OptionModel::getsByQuestionId($question->getId());
            foreach($options as $opt) {
                OptionModel::create($newQuestion->getId(), $opt->getValue(), $opt->getText());
            }
        }
    }
    public static function delete($template) {
        $template->delete();
        FormModel::delete($template->getFormId());
    }
}
