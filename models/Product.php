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
        private $imageDefault;
        private $errors;

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
            $this->errors = array();
        }

        public function getId()
        {
            return $this->ProductId;
        }

        public function getSeller()
        {
            return $this->Seller;
        }

        public function getDescription()
        {
            return $this->Description;
        }

        public function getCreatedBy()
        {
            return $this->CreatedBy;
        }

        public function getTitle()
        {
            return $this->Title;
        }
        
        public function getPrice()
        {
            return $this->Price;
        }

        public function getStock()
        {
            return $this->Stock;
        }

        public function getOffer()
        {
            return $this->Offer;
        }

        public function getSku()
        {
            return $this->Sku;
        }

        public function setImages($images)
        {
            $this->Images = $images;
        }

        public function getImages()
        {
            return $this->Images;
        }

        public function setDefaultImage($img)
        {
            $this->imageDefault = $img;
        }

        public function getDefaultImage()
        {
            return $this->imageDefault;
        }

        public function getErrors()
        {
            return $this->errors;
        }

        public function isValid() : bool
        {
            
            if (is_null($this->getTitle()) || $this->getTitle() === "")
                $this->errors['title'] = 'Informe o titulo.';

            if (is_null($this->getPrice()) )
                $this->errors['price'] = 'Informe o preço.';

            if (is_null($this->getStock()) )
                $this->errors['stock'] = 'Informe o estoque.';
            
            if (is_null($this->getOffer()))
                $this->errors['offer'] = 'Informe se é oferta ou não.';

            if (is_null($this->getSku()))
                $this->errors['sku'] = 'Informe o sku.';

            if (is_null($this->getDescription()) || $this->getDescription() === "")
                $this->errors['description'] = 'Informe o descritivo.';

            return count($this->errors) === 0;
        }
    }
?>