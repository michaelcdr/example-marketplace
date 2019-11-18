<?php

    namespace controllers;
    use controllers\IBaseController;
    use services\ProductService;

    class ProductListController implements IBaseController
    {
        private $_productService;

        public function __construct($factory)
        {
            $this->_productService = new ProductService($factory);
        }

        public function proccessRequest() : void
        {
            $page = 1;
            if (isset($_GET["p"])){
                $page = intval($_GET["p"]);
            }
            $paginatedResults = $this->_productService->getAllPaginatedAdmin($page, null);
            $products = $paginatedResults->results;
            require $_SERVER['DOCUMENT_ROOT'] . '\\views\\admin\\product\\lista.php';
        }
    }
    