<?php
    namespace models;

    class Checkout
    {
        private $_carrinho;
        private $_states;
        
        /**
         * Class constructor.
         */
        public function __construct($carrinho, $states)
        {
            $this->_carrinho = $carrinho;
            $this->_states = $states;
        }

        public function getCarrinho()
        {
            return $this->_carrinho;
        }
        public function getTotal()
        {
            return $this->_carrinho->getTotalFormatted();
        }
        public function getProducts()
        {
            return $this->_carrinho->getProducts();
        }
        public function getStates()
        {
            return $this->_states;
        }
    }