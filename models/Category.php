<?php

    namespace models;

    class Category
    {
        private $_categoryId;
        private $_title;        
        private $_image;
        
        public function getTitle()
        {
            return  $this->_title;
        }
        
        public function getId()
        {
            return  $this->_categoryId;
        }
        
        public function getImage()
        {
            return  $this->_image;
        }

        public function __construct(string $title)
        {
            $this->_title = $title;
        }
    }
?>