<?php
    namespace controllers;
    
    use controllers;
    use infra;
    use models;
    use infra\repositories;
    use services\ProductService;

    class ProductEditController implements IBaseController
    {
        private $productService;
        public function __construct($factory)
        {
            $this->productService = new ProductService($factory);
        }
        
        public function proccessRequest() : void
        {
            $product  = $this->productService->getById($_GET['id']);
            require $_SERVER['DOCUMENT_ROOT'] . '\\views\\admin\\product\\editar-produto.php';
        }
    }
?>