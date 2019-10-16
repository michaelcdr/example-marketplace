<?php
    //namespace infra\repository;
    require_once './infra/interfaces/ICategoryRepository.php';
    require_once './infra/MySqlRepository.php';
    
    class CategoryRepository extends MySqlRepository implements ICategoryRepository
    {
        public function getAll()
        {
            $query = "SELECT CategoryId, Title, Image FROM Categories";
            $resultado = $this->conn->query($query);
            $lista = $resultado->fetchAll();
            return $lista;
        }

        public function add($title)
        {
            $query = "INSERT INTO Categories (Title) values ('". $title ."') ";
            $this->conn->exec($query);
        }
    }
?>