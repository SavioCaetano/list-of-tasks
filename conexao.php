<?php

    class Conexao {
        private $host = 'localhost';
        private $dbname = 'data_base_name';
        private $user = 'user';
        private $pass = 'password';

        public function conectar () {
            try {

                $conexao = new PDO(
                    "mysql:host=$this->host;dbname=$this->dbname",
                    "$this->user", 
                    "$this->pass"
                );

                    return $conexao;

            } catch (PDOException $e) {
                echo '<p> ' . $e->getMessage() . '</p>';
            }
        }

    }

?>