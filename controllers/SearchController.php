<?php
    namespace controllers;
    use services\ProductService;

    class SearchController implements IBaseController
    {
         private $_productService;
        

        public function __construct($factory)
        {
            $this->_productService = new ProductService($factory);
        }
        
        public function proccessRequest() : void
        {
            $pagina = 0;
            if (isset($_GET["pagina"]))
                $pagina = $_GET["pagina"];

            $products = $this->_productService->getAllPaginatedAdmin(
                $pagina,
                $_GET["pesquisa"]
            )->results;
            require "views/home/pesquisa.php";
        }
    }
?>