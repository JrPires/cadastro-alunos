<?php

class MatriculaController extends Zend_Controller_Action
{
    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $matricula = new App_Model_DbTable_MatriculaRepository();
        $this->view->matricula = $matricula->listar();
    }

    public function addAction()
    {
        $form = new App_Form_MatriculaForm();
        $form->submit->setLabel('Adicionar');
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if (!$form->isValid($formData)) {
                $idAluno = $form->getValue('aluno');
                $idDisciplina = $form->getValue('disciplina');
                $matricula = new App_Model_DbTable_MatriculaRepository();
                $matricula->add($idAluno, $idDisciplina);

                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        }
    }

    public function editarAction()
    {
        $form = new App_Form_MatriculaForm();
        $form->submit->setLabel('Save');
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $id = (int)$form->getValue('id');
                $idAluno = $form->getValue('idAluno');
                $idDisciplina = $form->getValue('idDisciplina');
                $alunos = new App_Model_DbTable_MatriculaRepository();
                $alunos->editar($id, $idAluno, $idDisciplina);

                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        } else {
            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $matricula = new App_Model_DbTable_MatriculaRepository();
                $form->populate($matricula->getMatricula($id));
            }
        }
    }

    public function deleteAction()
    {
        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Yes') {
                $id = $this->getRequest()->getParam('id');
                $alunos = new App_Model_DbTable_MatriculaRepository();
                $alunos->excluir($id);
            }

            $this->_helper->redirector('index');
        } else {
            $id = $this->_getParam('id', 0);
            $matricula = new App_Model_DbTable_MatriculaRepository();
            $this->view->alunos = $matricula->getMatricula($id);
        }
    }
}