<?php
    namespace services;

    use models\CartViewModel;
    use models\ProductCart;

    class CartService 
    {
       
        private $_repoCart;
        private $_repoProd;

        public function __construct($factory)
        {
            $this->_repoCart = $factory->getCartRepository();
            $this->_repoProd = $factory->getProductRepository();
        }

        public function addProduct($productId)
        {
            //obtendo produto selecionado
            $product = $this->_repoProd->getById($productId);
            if (isset($_SESSION["cart"]))
            {
                //ja existe um carrinho na sessao...
                $cartViewModel = $_SESSION["cart"];
                
                //obtendo imagem principal...
                $firstImage = null;
                if (!is_null($product->getImages()) && count($product->getImages()) > 0)
                    $firstImage = $product->getImages()[0]["FileName"];

                //adicionando produto no objeto de carrinho
                $cartViewModel->addProduct(
                    new ProductCart(
                        null,
                        $cartViewModel->getCartGroup(),
                        $product->getId(),
                        $product->getTitle(),
                        $product->getPrice(),
                        1,
                        $firstImage,
                        $product->getPrice()
                    )
                );
                //atualizando na sessao
                $_SESSION["cart"] = $cartViewModel;
                return $cartViewModel;
            } 
            else 
            {
                //carrinho nao existe, criando
                $cartGroup = md5(uniqid(rand(), true));
                $products = array();
                $firstImage = null;
                if (!is_null($product->getImages()) && count($product->getImages()) > 0)
                    $firstImage = $product->getImages()[0]["FileName"];
                    
                $products[] = new ProductCart(
                    null,
                    $cartGroup,
                    $product->getId(),
                    $product->getTitle(),
                    $product->getPrice(),
                    1,
                    $firstImage,
                    $product->getPrice()
                );
                $cartViewModel = new CartViewModel(
                    $cartGroup,
                    $products,
                    $product->getPrice()
                );
                $_SESSION["cart"] = $cartViewModel;
                return $cartViewModel;
            }
        }

        public function getCurrentCart()
        {
            if (isset($_SESSION["cart"]))
            {
                //ja existe um carrinho
                return $_SESSION["cart"];
            }  
            else 
            {
                return null;
                // $cartId = md5(uniqid(rand(), true));
                // $products = $this->_repoProd->getById($id)
                // $_SESSION["cart"] = $cartId;
                // new CartViewModel(
                //     $this->_repoCart->getProducts($_SESSION["cart"]),
                //     $this->_repoCart->getFinalPrice($_SESSION["cart"])
                // )
                // $products[] = new ProductCart(
                //     $product["CartId"],
                //     $product["CartGroup"],
                //     $product["ProductId"],
                //     $product["Title"],
                //     $product["Price"],
                //     $product["Qtd"],
                //     $product["Image"],
                //     $product["SubTotal"]
                // );
            }
        }
    }