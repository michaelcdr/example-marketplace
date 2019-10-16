<?php
    
    namespace infra;
    
    abstract class MySqlRepository {

        protected $conn;

        public function __construct($conn){
            //echo "chegou em MySqlRepository";
            $this->conn = $conn;
        }
    } 
?>