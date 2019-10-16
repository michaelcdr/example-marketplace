<?php
    //namespace infra\repository;

    class ProductRepository implements IProductRepository
    {
        private $conn;

        public function __construct($connection)
        {
            $this->conn = $connection;
        }
    
        function getAll()
        {
            $query = "SELECT ProductId, Title, Description, CreatedAt, CreatedBy FROM Products";
            $conexao = DbConnection::Connect();
            $resultado = $conexao->query($query);
            $lista = $resultado->fetchAll();
            return $lista;
        }

        function add($nome,$description, $createdBy)
        {
            $query = "INSERT INTO Products(title, description, createdAt, createdBy) " . 
            "           values ('". $nome ."', '" . $description . "', now(), '".$createdBy."') ";

            $conexao = DbConnection::Connect();
            $conexao->exec($query);
        }

    }
?>