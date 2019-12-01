<?php
    namespace models;

    class Seller
    {
        private $_sellerId;
        private $_name; 
        private $_company;
        private $_lastName;
        private $_fantasyName; 
        private $_city;
        private $_login;
        
        public function __construct(
            $sellerId, $name,$lastName,$company,$fantasyName,$city,$login)
        {
            $this->_sellerId = $sellerId;
            $this->_name = $name;
            $this->_lastName = $lastName;
            $this->_company = $company;
            $this->_fantasyName = $fantasyName;
            $this->_city = $city;
            $this->_login = $login;
            
        }
        public function getLogin()
        {
            return $this->_login;
        }

        public function getSellerId()
        {
            return $this->_userId;
        }

        public function getName()
        {
            return $this->_name;
        }
        
        public function getLastName()
        {
            return $this->_lastName;
        }

        public function getFantasyName()
        {
            return $this->_fantasyName;
        }

        public function getCity()
        {
            return $this->_city;
        }
    }
?>