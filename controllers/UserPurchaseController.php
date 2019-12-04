<?php
    namespace controllers;
    use infra;
    use models;
    use infra\repositories;
    use models\JsonSuccess;
    use models\JsonError;
    use models\User;

    class UserPurchaseController implements IBaseController
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
            $compras = $paginatedResults->results;
            
            require "views/admin/users/lista-compras.php";
        }
    }
?>