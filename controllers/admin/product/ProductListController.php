<?php

    namespace controllers\admin\product;
    use controllers\IBaseController;

    class ProductListController implements IBaseController
    {
        private $_repoProduct;

        public function __construct($factory)
        {
            $this->_repoProduct = $factory->getProductRepository();
        }

        public function proccessRequest() : void
        {
            $products = $this->_repoProduct->getAll(0, null);
            require $_SERVER['DOCUMENT_ROOT'] . '\\views\\admin\\product\\lista-produto.php';
        }
    }
    