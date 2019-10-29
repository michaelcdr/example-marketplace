<?php 
    
    namespace infra\interfaces;
    
    interface ICartRepository 
    {
        public function addProduct($productId, $cartId);
        public function getQtdProduct($productId, $cartId);
        
    }

?>