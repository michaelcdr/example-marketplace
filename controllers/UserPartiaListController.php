<?php
    namespace controllers;
    use infra;    
    use infra\repositories;

    class UserPartiaListController implements IBaseController
    {
        private $_repoUser;

        public function __construct($factory)
        {
            $this->_repoUser = $factory->getUserRepository();
        }
        
        public function proccessRequest() : void
        {
            $search = null;
            if (isset($_POST["s"]))
                $search = $_POST["s"];
            
            $users = $this->_repoUser->getAll(0, $search);
            require "views/admin/users/lista-usuarios-table.php";
        }
    }
?>