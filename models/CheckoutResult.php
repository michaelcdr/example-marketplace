<?php
    namespace models;

    class CheckoutResult
    {
        public $success;
        
        public function __construct($success)
        {
            $this->success = $success;
        }

    }