<?php

class AlunoController extends Zend_Controller_Action
{
    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        try {
            $alunosModel = new App_Model_DbTable_AlunoRepository();
            $alunos = $alunosModel->listar();
            $this->view->alunos = $alunos;

        } catch (Exception $exception) {
            throw $exception;
        }
    }

    public function addAction()
    {
        $form = new App_Form_AlunoForm();
        $form->submit->setLabel('Adicionar');
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $nome = $form->getValue('nome');
                $email = $form->getValue('email');
                $alunos = new App_Model_DbTable_AlunoRepository();
                $alunos->add($nome, $email);

                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        }

    }

    public function editarAction()
    {
        $form = new App_Form_AlunoForm();
        $form->submit->setLabel('Save');
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $id = (int)$form->getValue('id');
                $nome = $form->getValue('nome');
                $email = $form->getValue('email');
                $alunos = new App_Model_DbTable_AlunoRepository();
                $alunos->editar($id, $nome, $email);

                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        } else {
            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $alunos = new App_Model_DbTable_AlunoRepository();
                $form->populate($alunos->getAluno($id));
            }
        }

    }

    public function excluirAction()
    {
        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Yes') {
                $id = $this->getRequest()->getPost('id');
                $alunos = new App_Model_DbTable_AlunoRepository();
                $alunos->delete($id);
            }
            $this->_helper->redirector('index');
        } else {
            $id = $this->_getParam('id', 0);
            $alunos = new App_Model_DbTable_AlunoRepository();
            $this->view->alunos = $alunos->getAluno($id);
        }
    }
}