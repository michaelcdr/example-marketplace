<?php
    namespace models;

    class UserEdit
    {
        public function __construct($userId,$login,$name,$role)
        {
            $this->userId = $userId;
            $this->login = $login;
            $this->name = $name;
            $this->role = $role;
        }

        private $errors = array();
        private $userId;
        private $login;
        private $name;
        private $role;

        public function getUserId()
        {
            return $this->userId;
        }

        public function getLogin()
        {
            return $this->login;
        }

        public function getName()
        {
            return $this->name;
        }

        public function getRole()
        {
            return $this->role;
        }

        public function errors()
        {
            return $this->errors;
        }

        public function isValid()
        {
            $this->validateName();
            $this->validateLogin();
            $this->validateRole();
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

        private function validateRole()
        {
            if ($this->getRole() === '')
                $this->errors['role'] = 'Informe o tipo de usuário.';
        }
    }

?>