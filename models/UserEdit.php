<?php
    namespace models;

    class UserEdit {
        public function __construct($userId,$login,$name)
        {
            $this->userId = $userId;
            $this->login = $login;
            $this->name = $name;
        }

        private $errors = array();
        private $userId;
        private $login;
        private $name;

        public function getUserId(){
            return $this->userId;
        }

        public function getLogin(){
            return $this->login;
        }

        public function getName(){
            return $this->name;
        }

        public function errors()
        {
            return $this->errors;
        }

        public function isValid()
        {
            $this->validateName();
            $this->validateLogin();

            return count($this->errors) === 0;
        }

        private function validateName()
        {
            if ($this->getName() === '')
                $this->errors['name'] = 'Informe o nome.';
        }

       

        private function validateLogin()
        {
            if ($this->getLogin() === '')
                $this->errors['login'] = 'Informe o login.';
        }

    }

?>