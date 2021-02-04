<?php
namespace Yuforms\Api\Controller;

use Yuforms\Api\Core\Controller;
use Yuforms\Api\Other\Time;

class NewForm extends Controller {
    protected function post() {
        $this->createForm();
        $this->addQuestions();
    }
    private function createForm() {
        $this->memberQuery = new \MemberQuery();
        $this->member = $this->memberQuery->findPK($this->userId);
        $this->form = new \Form();
        $this->form->setMember($this->member);
        $this->form->setName($this->data['formTitle']);
        $this->form->setCreateDateTime(Time::current());
        $this->form->save();
        $id = $this->form->getId();
        $this->response([
            'formSlug'=>'formSlugResponsedBackEnd',
            'formId'=>$id
        ]);
    }
    private function addQuestions() {
        foreach($this->data['questions'] as $key=>$q) {
            $question = new \Question();
            $question->setText($q['questionText']);
            $formComponent = \FormComponentQuery::create()->filterByFormComponentName($q['formComponentType'])->findOne();
            $formComponentId = $formComponent->getId();
            $question->setFormComponentId($formComponentId);
            $question->save();
            $formItem = new \FormItem();
            $formItem->setQuestionId($question->getId());
            $formItem->setFormId($this->form->getId());
            $formItem->save();
            if($formComponent->getHasOptions()) {
                foreach(array_values($q['options']) as $id=>$o) {
                    if(isset($o['value'])) { // for last option, temporary solution, I will fix it side of client as best practice
                        $option = new \Option();
                        $option->setText($o['value']);  // client side value is not equal database value
                        $option->setValue($id);
                        $option->setQuestionId($question->getId());
                        $option->save();
                    }
                }
            }
        }
    }
}
