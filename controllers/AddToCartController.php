<?php
    namespace controllers;
    use services\CartService;
    class AddToCartController implements IBaseController
    {
        private $_cartService;
        
        public function __construct($factory)
        {
            $this->_cartService = new CartService($factory);
        }

        public function proccessRequest() : void
        {
            $cartViewModel = $this->_cartService->addProduct($_GET["id"]);
            // echo "<pre>";
            // var_dump($cartViewModel->getTotal());
            // echo "</pre>";
            header("location: /carrinho");
        }
    }
?>