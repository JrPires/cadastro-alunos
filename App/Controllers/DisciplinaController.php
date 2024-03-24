<?php

class DisciplinaController extends Zend_Controller_Action
{
    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $disciplina = new App_Model_DbTable_DisciplinaRepository();
        $this->view->disciplina = $disciplina->fetchAll();
    }

    public function addAction()
    {
        $form = new App_Form_DisciplinaForm();
        $form->submit->setLabel('Adicionar');
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $nome = $form->getValue('nome');
                $disciplina = new App_Model_DbTable_DisciplinaRepository();
                $disciplina->add($nome);

                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        }
    }

    public function editarAction()
    {
        $form = new App_Form_DisciplinaForm();
        $form->submit->setLabel('Save');
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $id = (int)$form->getValue('id');
                $nome = $form->getValue('nome');
                $disciplina = new App_Model_DbTable_DisciplinaRepository();
                $disciplina->editar($id, $nome);

                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        } else {
            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $disciplina = new App_Model_DbTable_DisciplinaRepository();
                $form->populate($disciplina->getDisciplina($id));
            }
        }
    }

    public function deleteAction()
    {
        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Yes') {
                $id = $this->getRequest()->getPost('id');
                $disciplina = new App_Model_DbTable_DisciplinaRepository();
                $disciplina->delete($id);
            }
            $this->_helper->redirector('index');
        } else {
            $id = $this->_getParam('id', 0);
            $disciplina = new App_Model_DbTable_DisciplinaRepository();
            $this->view->disciplina = $disciplina->getDisciplina($id);
        }
    }
}