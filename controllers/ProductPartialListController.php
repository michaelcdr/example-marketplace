<?php

    namespace controllers;
    use controllers\IBaseController;
    use services\ProductService;

    class ProductPartialListController implements IBaseController
    {
        private $_productService;

        public function __construct($factory)
        {
            $this->_productService = new ProductService($factory);
        }

        public function proccessRequest() : void
        {   
            $paginatedResults = $this->_productService->getAllPaginatedAdmin();
            $products = $paginatedResults ->results;
            require $_SERVER['DOCUMENT_ROOT'] . '\\views\\admin\\product\\lista-table.php';
        }
    }
    