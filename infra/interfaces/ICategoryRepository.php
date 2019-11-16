<?php
    namespace infra\interfaces;
    interface ICategoryRepository 
    {
        public function getAll($page, $search);
    }
?>