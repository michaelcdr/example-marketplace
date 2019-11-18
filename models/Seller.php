<?php
    namespace models;

    class Seller
    {
        private $_userId;
        private $_name; 

        public function __construct($userId, $name)
        {
            $this->_userId = $userId;
            $this->_name = $name;
        }

        public function getId()
        {
            return $this->_userId;
        }

        public function getName()
        {
            return $this->_name;
        }
    }
?>