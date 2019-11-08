<?php
    namespace infra\interfaces;
    
    interface IProductRepository 
    {
        // public function add($user);
        // public function remove($user);
        public function getAll( $page, $skip);
        public function add($product);
        public function getCurrentStock($productId);
    }
?>