<?php
    namespace models;

    class User 
    {
        public function __construct($userId,$login,$password,$name,$role)
        {
            $this->userId = $userId;
            $this->login = $login;
            $this->password = $password;
            $this->name = $name;
            $this->role=$role;
        }

        private $errors = array();
        private $userId;
        private $login;
        private $password;
        private $name;
        private $role;

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
        public function getRole(){
            return $this->role;
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