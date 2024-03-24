<?php

class App_Form_AlunoForm extends Zend_Form
{
    public function init()
    {
        $this->setName('aluno');

        $id = new Zend_Form_Element_Hidden('id');
        $id->addFilter('Int');

        $nome= new Zend_Form_Element_Text('nome');
        $nome->setLabel('Nome')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty');

        $email = new Zend_Form_Element_Text('email');
        $email->setLabel('Email')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty');

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'submitbutton');

        $this->addElements(array($id, $nome, $email, $submit));
    }
}