<?php
    namespace controllers;
    use infra;
    use infra\repositories;

    class UserController implements IBaseController
    {
        private $_repoUser;

        public function __construct($factory)
        {
            $this->_repoUser = $factory->getUserRepository();
        }
        
        public function proccessLoginRequest() : void
        {
            require "views/usuario/login.php";
        }

        public function proccessRequest() : void
        {
            require "views/usuario/login.php";
        }
        
    }
?>