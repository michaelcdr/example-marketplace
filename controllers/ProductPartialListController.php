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
            $page = 0;
            if (isset($_GET["p"])){
                $page = intval($_GET["p"]);
            }
            $paginatedResult = $this->_productService->getAllPaginatedAdmin(
                $page, $_POST["s"]
            );
            $products = $paginatedResult->results;
            require $_SERVER['DOCUMENT_ROOT'] . '\\views\\admin\\product\\lista-table.php';
        }
    }
    