<?php
    namespace controllers;
    
    use controllers;
    use infra;
    use models;
    use infra\repositories;

    class UserEditController implements IBaseController
    {
        private $_repoUser;

        public function __construct($factory)
        {
            $this->_repoUser = $factory->getUserRepository();
        }
        
        
        public function proccessRequest() : void
        {
            $id = $_GET["id"];
            $user = $this->_repoUser->getById($id);
            require "views/admin/users/editar-usuario.php";
        }
    }
?>