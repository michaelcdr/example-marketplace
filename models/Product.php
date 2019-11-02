<?php
    namespace models;

    class Product
    {
        private $ProductId;
        private $Title;        
        private $Description;
        private $CreatedAt;
        private $CreatedBy;
        private $Price;
        private $Sku;
        private $Stock;
        private $Offer;
        private $Seller;
        private $Images;

      
        public function __construct($id, $title, $price, $description, $createdAt, $createdBy,$offer,$stock,$sku)
        {
            $this->ProductId = $id;
            $this->Title = $title;
            $this->Price = $price;
            $this->Description = $description;
            $this->CreatedAt = $createdAt;
            $this->CreatedBy = $createdBy;
            
            $this->Offer = $offer;
            $this->Sku = $sku;
            $this->Stock = $stock;
            
        }

        public function getId(){
            return $this->ProductId;
        }

        public function getSeller(){
            return $this->Seller;
        }

        public function getDescription(){
            return $this->Description;
        }

        public function getTitle(){
            return $this->Title;
        }
        
        public function getPrice(){
            return $this->Price;
        }

        public function getStock(){
            return $this->Stock;
        }

        public function getOffer(){
            return $this->Offer;
        }

        public function getSku(){
            return $this->Sku;
        }

        public function setImages($images){

            $this->Images = $images;
        }

        public function getImages(){

            return $this->Images;
        }
    }
?>