<?php 
    
    namespace infra\interfaces;
    
    interface ISellerRepository
    {
        public function addSimplifiedSeller($userId, $lastName);
        public function getAll($page, $search, $pageSize);
        public function total($search);
    }

?>