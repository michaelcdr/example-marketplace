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
            // echo 'senhaPura: ' . $senhaPura .', largurastring:' . strlen($senhaPura). '<br />';

            // echo  ($this->getPassword() === '$argon2i$v=19$m=65536,t=4,p=1$RXNsMjJPRkJUeG41aXZUVw$h22bjCngKPie/FrJheiGgFmF/YSh5sqSRzC/ZS0MdCc');
            // echo  '<br />';
            // echo $this->getPassword();
            // echo  '<br />';
            // echo '$argon2i$v=19$m=65536,t=4,p=1$RXNsMjJPRkJUeG41aXZUVw$h22bjCngKPie/FrJheiGgFmF/YSh5sqSRzC/ZS0MdCc';
            // echo  '<br />';
            //echo 'senha 2: ' .  $this->getPassword() .'<br />';
            //echo 'verificacao retorno: '  . password_verify($senhaPura, $this->getPassword()) .'<br />';
            
            
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