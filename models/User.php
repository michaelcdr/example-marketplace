<?php

    class User {

        public function __construct($login,$password,$nome){
            $this->login = $login;
            $this->password = $password;
            $this->nome = $nome;
        }


        private $login;
        private $password;
        private $nome;

        public function getLogin(){
            return $this->login;
        }

        public function getNome(){
            return $this->nome;
        }
    }

?>