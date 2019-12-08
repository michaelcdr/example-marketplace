<?php
    namespace models;

    class Address
    {
        private $_addressId;
        private $_userId;
        private $_street;
        private $_cep;
        private $_neighborhood;
        private $_city;
        private $_stateid;
        private $_complement;

        /**
         * Class constructor.
         */
        public function __construct(
            $addressId, $userId, $street, $cep, $neighborhood, $city, $stateId, $complement)
        {
            $this->_addressId = $addressId;
            $this->_userId = $userId;
            $this->_street = $street;
            $this->_cep = $cep;
            $this->_neighborhood = $neighborhood;
            $this->_city = $city;
            $this->_stateid = $stateId;
            $this->_complement = $complement;
        }

        public function getAddressId()
        {
            return $this->_addressId;
        }
        public function getUserId()
        {
            return $this->_userId;
        }
        public function getStreet()
        {
            return $this->_street;
        }
        public function getCep()
        {
            return $this->_cep;
        }
        public function getNeighborhood()
        {
            return $this->_neighborhood;
        }
        public function getCity()
        {
            return $this->_city;
        }
        public function getStateId()
        {
            return $this->_stateid;
        }
        public function getComplement()
        {
            return $this->_complement;
        }
    }