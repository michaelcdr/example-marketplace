<?php
    abstract class MySqlRepository {

        protected $conn;

        public function __construct($conn){
            $this->conn = $conn;
        }
    } 
?>