<?php
    namespace models;

    class User {
        public function __construct($userId,$login,$password,$name)
        {
            $this->userId = $userId;
            $this->login = $login;

            //usando padrao de senha argon2
            $this->password = $password;
            $this->name = $name;
        }

        private $errors = array();
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
            return password_verify($senhaPura,  $this->getPassword());
        }

        public function errors()
        {
            return $this->errors;
        }

        public function isValid()
        {
            $this->validateName();
            $this->validatePassword();
            $this->validateLogin();

            return count($this->errors) === 0;
        }

        private function validateName()
        {
            if ($this->getName() === '')
                $this->errors['name'] = 'Informe o nome.';
        }

        private function validatePassword()
        {
            if ($this->getPassword() === '')
                $this->errors['password'] = 'Informe a senha.';
        }

        private function validateLogin()
        {
            if ($this->getLogin() === '')
                $this->errors['login'] = 'Informe o login.';
        }

    }

?>