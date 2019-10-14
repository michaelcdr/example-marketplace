<?php
    class Category
    {
        private $CategoryId;
        private $Title;        
        private $Image;
        
        public function __get($title)
        {
            return $this->$Title;            
        }
        
        public function __construct(string $title)
        {
            $this->Title = $title;
        }
    }
?>