<?php
    namespace controllers;
    use infra;
    use infra\repositories;
    use PDO;
    
    class DetailsProductController implements IBaseController
    {
        private $_repoProduct;

        public function __construct($factory)
        {
            $this->_repoProduct = $factory->getProductRepository();
        }
        
        public function proccessRequest() : void
        {
            if (is_null($_GET["id"]) || !isset($_GET["id"]))
                header('location: /');

            $product = $this->_repoProduct->getById($_GET["id"]);
            require "views/produto/detalhes-produto.php";
        }
    }
?>