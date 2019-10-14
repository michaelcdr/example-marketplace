<?php 

    class MySqlRepositoryFactory extends RepositoryFactory {

        private $host = "localhost";
        private $db_name = "ProjetoUCS";
        private $port = "3306";
        private $username = "root";
        private $password = "giacom";
        public $conn;
    
        //obtendo conexão
        public function getConnection()
        {
            $this->conn = null;
            try
            {
                $this->conn = new PDO("mysql:host=" . $this->host . 
                    ";port=" . $this->port . 
                    ";dbname=" . $this->db_name, 
                    $this->username, 
                    $this->password
                );
                // echo '<pre>';
                // print_r($this->conn);
                // echo '</pre>';
                //echo "pdo connection ok<br/>";
            }
            catch (PDOException $exception)
            {
                //echo "Não foi possivel conectar-se ao banco de dados, erro ocorrido: " .
                $exception->getMessage();
            }
            return $this->conn;
        }

        public function getUserRepository() 
        {
            return new UserRepository($this->getConnection());
        }

        public function getProductOnOfferRepository() 
        {
            return new ProductOnOfferRepository($this->getConnection());
        }

        public function getProductRepository() 
        {
            return new ProductRepository($this->getConnection());
        }

        public function getCarouselRepository()
        {
            return new CarouselRepository($this->getConnection());
        }
        
        public function getCategoryRepository()
        {
            return new CategoryRepository($this->getConnection());
        }
    }

?>