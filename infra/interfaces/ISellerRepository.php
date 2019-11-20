<?php 
    
    namespace infra\interfaces;
    
    interface ISellerRepository
    {
        public function addSimplifiedSeller($userId, $lastName);
    }

?>