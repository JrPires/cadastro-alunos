<?php

class App_Model_DbTable_AlunoRepository extends Zend_Db_Table_Abstract
{
    protected $_name = 'Aluno';

    public function listar()
    {
        return $this->fetchAll();
    }

    public function getAluno($id)
    {
        $id = (int)$id;
        $row = $this->fetchRow('id = ' . $id);
        if (!$row) {
            throw new Exception("Could not find row $id");
        }
        return $row->toArray();
    }

    public function add($nome, $email)
    {
        $data = array(
            'nome' => $nome,
            'email' => $email,
        );
        $this->insert($data);
    }

    public function editar($id, $nome, $email)
    {
        $data = array(
            'nome' => $nome,
            'email' => $email,
        );
        $this->update($data, 'id = '. (int)$id);
    }

    public function delete($id)
    {
        $this->delete('id =' . (int)$id);
    }
}