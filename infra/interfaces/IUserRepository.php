<?php 
    
    
    interface IUserRepository 
    {

        public function add($user);
        public function remove($user);
        public function altera($user);
        public function getById($id);
        public function getByLogin($login);
        public function getAll( $page, $skip,$take);
    }

?>