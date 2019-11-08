<?php   

    namespace models\responses;
    
    class UpdateQtdProductResponse 
    {
        /**
         * Class constructor.
         */
        public function __construct(bool $success, string $msg, int $stock)
        {
            $this->_success = $success;
            $this->_msg = $msg;
            $this->_stock = $stock;
        }

        private $_success;
        private $_msg;
        private $_stock;

        public function getMsg()
        {
            return $this->_msg;
        }

        public function getStock()
        {
            return $this->_stock;
        }

        public function getSuccess()
        {
            return $this->_success;
        }
    }
    