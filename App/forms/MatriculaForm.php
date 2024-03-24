<?php

class App_Form_MatriculaForm extends Zend_Form
{
    public function init()
    {
        $this->setName('matricula');

        $id = new Zend_Form_Element_Hidden('id');
        $id->addFilter('Int');

        $alunoSelect = new Zend_Form_Element_Select('aluno');
        $alunoSelect->setLabel('Aluno')
            ->setRequired(true)
            ->addValidator('NotEmpty');

        $alunoRepository = new App_Model_DbTable_AlunoRepository();
        $alunos = $alunoRepository->fetchAll();
        $alunoOptions = array();
        foreach ($alunos as $aluno) {
            $alunoOptions[$aluno->id] = $aluno->nome;
        }
        $alunoSelect->addMultiOptions($alunoOptions);

        $disciplinaSelect = new Zend_Form_Element_Select('disciplina');
        $disciplinaSelect->setLabel('Disciplina')
            ->setRequired(true)
            ->addValidator('NotEmpty')
            ->setAttrib('multiple', true);

        $disciplinaRepository = new App_Model_DbTable_DisciplinaRepository();
        $disciplinas = $disciplinaRepository->fetchAll();
        $disciplinaOptions = array();
        foreach ($disciplinas as $disciplina) {
            $disciplinaOptions[$disciplina->id] = $disciplina->nome;
        }
        $disciplinaSelect->addMultiOptions($disciplinaOptions);

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'submitbutton');

        $this->addElements(array($id, $alunoSelect, $disciplinaSelect, $submit));
    }
}