<?php

class App_Model_DbTable_MatriculaRepository extends Zend_Db_Table_Abstract
{
    protected $_name = 'Matricula';

    public function listar()
    {
        $db = Zend_Db_Table_Abstract::getDefaultAdapter();
        $sql = "SELECT m.id, a.nome as aluno, d.nome as disciplina FROM Matricula as m
                LEFT JOIN Aluno as a on a.id = m.id_aluno
                LEFT JOIN Disciplina as d on d.id = m.id_disciplina";

        $stmt = $db->query($sql);

        return $stmt->fetchAll();
    }

    public function getMatricula($id)
    {
        $id = (int)$id;
        $row = $this->fetchRow('id = ' . $id);
        if (!$row) {
            throw new Exception("Could not find row $id");
        }

        return $row->toArray();
    }

    public function add($idAluno, $idDisciplinas)
    {
        foreach ($idDisciplinas as $idDisciplina) {
            $data = array(
                'id_aluno' => $idAluno,
                'id_disciplina' => $idDisciplina
            );

            $this->insert($data);
        }
    }

    public function editar($id, $idAluno, $idDisciplina)
    {
        $data = array(
            'idAluno' => $idAluno,
            'idDisciplina' => $idDisciplina
        );

        $this->update($data, 'id = '. (int)$id);
    }

    public function excluir($id)
    {
        $this->delete('id =' . (int)$id);
    }
}