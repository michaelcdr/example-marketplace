<?php
    namespace services;


    class AuthService 
    {
        private $_path;
        public function __construct($caminho)
        {
            $this->_path = $caminho;
        }

        public function isAuthorized() : bool
        {
            
        }
    }