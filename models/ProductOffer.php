<?php 

    class ProductOffer
    {
        private $ProductId;
        private $Title;
        private $Price;

        public function __construct($productId, $title, $price)
        {
            $this->ProductId = $productId;
            $this->Title = $title;
            $this->Price = $price;
        }
        
        public function getProductId(){
            return $this->ProductId;
        }
        public function getTitle(){
            return $this->Title;
        }
        public function getPrice(){
            return $this->Price;
        }
    }

?>