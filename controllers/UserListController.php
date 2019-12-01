<?php
    namespace controllers;
    use controllers\IBaseController;

    class UserListController implements IBaseController
    {
        private $_repoOrder;

        public function __construct($factory)
        {
            $this->_repoOrder = $factory->getOrderRepository();
        }
        
        public function proccessRequest() : void
        {
            $page = 1;
            if (isset($_GET["p"]))
                $page = intval($_GET["p"]);
            
            $paginatedResults = $this->_repoOrder->getAll($page, null, 5);
            $users = $paginatedResults->results;
            require "views/admin/users/lista-compras.php";
        }
    }
?>