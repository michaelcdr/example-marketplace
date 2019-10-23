<?php
    namespace models;

    class User {

      
        public function __construct($userId,$login,$password,$name){
            $this->userId = $userId;
            $this->login = $login;
            $this->password = $password;
            $this->name = $name;
        }

        private $userId;
        private $login;
        private $password;
        private $name;

        public function getUserId(){
            return $this->userId;
        }

        public function getLogin(){
            return $this->login;
        }

        public function getPassword(){
            return $this->password;
        }

        public function getName(){
            return $this->name;
        }

        public function passwordIsValid(string $senhaPura) : bool
        {
            return password_verify($senhaPura, $this->password);
        }
    }

?>