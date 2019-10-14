<?php

    interface IProductRepository 
    {
        // public function add($user);
        // public function remove($user);
        public function getAll( $page, $skip, $take);
        public function add($nome,$description,$price,$createdBy);
    }
?>