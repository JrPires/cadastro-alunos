<?php

class App_Form_DisciplinaForm extends Zend_Form
{
    public function init()
    {
        $this->setName('disciplina');

        $id = new Zend_Form_Element_Hidden('id');
        $id->addFilter('Int');

        $nome= new Zend_Form_Element_Text('nome');
        $nome->setLabel('Nome')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty');

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'submitbutton');

        $this->addElements(array($id, $nome, $submit));
    }

}