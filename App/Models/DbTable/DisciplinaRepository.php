<?php

class App_Model_DbTable_DisciplinaRepository extends Zend_Db_Table_Abstract
{
    protected $_name = 'Disciplina';

    public function getDisciplina($id)
    {
        $id = (int)$id;
        $row = $this->fetchRow('id = ' . $id);
        if (!$row) {
            throw new Exception("Could not find row $id");
        }

        return $row->toArray();
    }

    public function add($disciplina)
    {
        $data = array(
            'nome' => $disciplina
        );

        $this->insert($data);
    }

    public function editar($id, $disciplina)
    {
        $data = array(
            'nome' => $disciplina
        );

        $this->update($data, 'id = '. (int)$id);
    }

    public function delete($id)
    {
        $this->delete('id =' . (int)$id);
    }
}