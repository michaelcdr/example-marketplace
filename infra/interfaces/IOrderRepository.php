<?php 
    
    namespace infra\interfaces;
    
    interface IOrderRepository 
    {
        public function add($order);
        public function getById($id);
    }

?>