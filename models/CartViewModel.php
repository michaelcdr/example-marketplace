<?php
    namespace models;

    class CartViewModel
    {
        private $total;
        private $products;
        private $cartGroup;

        public function __construct($cartGroup,$products, $total)
        {
            $this->cartGroup = $cartGroup;
            $this->total = $total;
            $this->products = $products;
        }

        /**
         * Get the value of total
         */ 
        public function getTotal()
        {
            return $this->total;
        }

        /**
         * Get the value of products
         */ 
        public function getProducts()
        {
            return $this->products;
        }

        public function getCartGroup()
        {
            return $this->cartGroup;
        }

        public function removeProduct($productId)
        {
            //echo count($this->getProducts()) . "<br/>";

            if (!is_null($this->getProducts()))
            {
                $posicao = -1;
                $indexAtual = 0; 
                foreach ($this->getProducts() as $productItem)
                {
                    if ($productId === $productItem->getProductId())
                    {
                        $posicao = $indexAtual;
                    }
                    $indexAtual++;
                }

                if ($posicao > -1)
                {
                    $itens = $this->getProducts();
                    array_splice($itens, $posicao, 1);
                    //var_dump($itens);
                    $this->products = $itens;
                }

                // echo '<br>';
                // echo $posicao;
                // echo '<br>';
                // echo count($this->getProducts());
                // var_dump($this->getProducts());
                // exit();
            }
        }
        
        public function addProduct($product)
        {
            if (!is_null($this->getProducts()))
            {
                //ja tem produtos...
                $existe = false;
                foreach ($this->getProducts() as $productItem)
                {
                    if ($product->getProductId() ==  $productItem->getProductId())
                    {
                        $productItem->incrementQtd(); 
                        $existe = true;
                    } 
                }

                if (!$existe)
                    $this->products[] = $product;
            }
        }

        public function getQtdProducts(){

            $total = 0;
            foreach ($this->getProducts() as $productItem)
            {
                $total += $productItem->getQtd();
                
            }
            return $total;
        }
    }