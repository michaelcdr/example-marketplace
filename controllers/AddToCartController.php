<?php
    namespace controllers;
    
    use controllers;
    use infra;
    use models;
    use infra\repositories;

    class AddToCartController implements IBaseController
    {
        private $_repoCart;
        
        public function __construct($factory)
        {
            $this->_repoCart = $factory->getCartRepository();
        }
        
        public function proccessRequest() : void
        {
            $productId = $_GET["id"];
            if (isset($_SESSION["cart"]))
            {
                echo "produto com sessao, id : " . $productId;
                echo "<br> sessao de id: " .$_SESSION["cart"];
                $this->_repoCart->addProduct($productId,$_SESSION["cart"]);
            } 
            else {
                echo "produto sem sessao, id : " . $productId;
                $cartId = md5(uniqid(rand(), true));
                $_SESSION["cart"] = $cartId;

                $this->_repoCart->addProduct($productId,$cartId);
            }
            //$user = $this->_repoUser->getById($id);
            //require "views/home/carrinho.php";
        }
    }
?>