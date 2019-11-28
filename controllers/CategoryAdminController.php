<?php
    namespace controllers;
    require_once './infra/repositories-mysql/CategoryRepository.php';
    require_once './infra/MySqlRepositoryFactory.php';
    
    class CategoryAdminController  implements IBaseController
    {
        private $_repoCategories;

        public function __construct($factory)
        {
            $this->_repoCategories = $factory->getCategoryRepository();
        }

        public function proccessRequest() : void
        {
            $page = 1;
            if (isset($_GET["p"]))
                $page = intval($_GET["p"]);
            
            $paginatedResults = $this->_repoCategories->getAll($page, null, 5);
            $categories = $paginatedResults->results;
            require "views/admin/users/lista-usuario.php";
        }
    }
?>