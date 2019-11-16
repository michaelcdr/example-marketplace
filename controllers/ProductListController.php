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
            
            $products = $this->_productService->getAllPaginatedAdmin(0, null);
            
            require $_SERVER['DOCUMENT_ROOT'] . '\\views\\admin\\product\\lista-produto.php';
        }
    }
    