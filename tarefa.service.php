<?php

    //CRUD
    class TarefaService {

        private $conexao;
        private $tarefa;

        public function __construct(Conexao $conexao, Tarefa $tarefa) {
            $this->conexao = $conexao->conectar();
            $this->tarefa = $tarefa;
        }

        public function inserir () { //Create
            $query = 'insert into tarefas(tarefa)values(:tarefa)';

            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':tarefa', $this->tarefa->__get('tarefa'));
            $stmt->execute();
        }

        public function recuperar () { //Read
            $query = '
                select T.id, status, tarefa 
                from tarefas as T
                left join status as S on S.id = T.id_status
            ';

            $stmt = $this->conexao->prepare($query);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        public function atualizar () { //Update
            $query = 'update tarefas set tarefa = :tarefa where id = :id';

            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':tarefa', $this->tarefa->__get('tarefa'));
            $stmt->bindValue(':id', $this->tarefa->__get('id'));
            
            return $stmt->execute();
        }

        public function remover () { //Delete
            $query = 'delete from tarefas where id = :id';
            $stmt = $this->conexao->prepare($query);            
            $stmt->bindValue(':id', $this->tarefa->__get('id'));
            
            $stmt->execute();
        }

        public function realizada () {
            $query = 'update tarefas set id_status = ? where id = ?';

            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(1, $this->tarefa->__get('id_status'));
            $stmt->bindValue(2, $this->tarefa->__get('id'));
            
            return $stmt->execute();
        }

        public function recuperarPendentes() {
            $query = '
                select T.id, status, tarefa 
                from tarefas as T
                left join status as S on S.id = T.id_status
                where T.id_status = :id_status
            ';

            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':id_status', $this->tarefa->__get('id_status'));
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }
    }
?>