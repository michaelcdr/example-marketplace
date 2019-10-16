<?php
    namespace models;

    class User {

        public function __construct($login,$password,$name){
            $this->login = $login;
            $this->password = $password;
            $this->name = $name;
        }
        
        private $login;
        private $password;
        private $name;

        public function getLogin(){
            return $this->login;
        }

        public function getPassword(){
            return $this->password;
        }

        public function getName(){
            return $this->name;
        }

        
    }

?>