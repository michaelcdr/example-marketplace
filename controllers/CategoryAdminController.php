<?php
    require_once './infra/repositories-mysql/CategoryRepository.php';
    require_once './infra/MySqlRepositoryFactory.php';
    
    class CategoryAdminController
    {
        private $_repoCategories;

        public function __construct($factory)
        {
            $this->_repoCategories = $factory->getCategoryRepository();
        }

        public function getCategories()
        {
            return $this->_repoCategories->getAll();
        }
    }
?>