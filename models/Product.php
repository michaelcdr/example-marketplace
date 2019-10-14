<?php
    class Product
    {
        private $ProductId;
        private $Title;        
        private $Description;
        private $CreatedAt;
        private $CreatedBy;

        public function __get($title)
        {
            return $this->$Title;            
        }
        
        public function __construct($title, $description, $createdAt, $createdBy)
        {
            $this->Title = $title;
            $this->Description = $description;
            $this->CreatedAt = $createdAt;
            $this->CreatedBy = $createdBy;
        }
    }
?>