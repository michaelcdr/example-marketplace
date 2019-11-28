<?php 
    
    namespace infra;
    use infra\repositories;
    use infra\repositories\ProductOnOfferRepository;
    use infra\repositories\ProductRepository;
    use infra\repositories\CarouselRepository;
    use infra\repositories\UserRepository;
    use infra\repositories\SeedRepository;
    use infra\repositories\CartRepository;
    use infra\repositories\CategoryRepository;
    use infra\repositories\SellerRepository;
    use infra\RepositoryFactory;

    use PDO;

    class MySqlRepositoryFactory extends RepositoryFactory {

        private $host = "localhost";
        private $db_name = "projetoucs";
        private $port = "3306";
        private $username = "root";
        private $password = null;
        //private $password = "giacom";
        public $conn;
    
        //obtendo conexão
        public function getConnection()
        {
            $this->conn = null;
            try
            {
                
                $this->conn = new PDO(
                    "mysql:host=" . $this->host . 
                    ";port=" . $this->port . 
                    ";dbname=" . $this->db_name, 
                    $this->username, 
                    $this->password
                );
                //echo 'conexao feita com pdo';
            }
            catch (PDOException $exception)
            {
                //echo "erro ao tentar conectar com pdo: " .
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
            //echo "chegou em getProductOnOfferRepository<br/>";
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

        public function getSeedRepository()
        {
            return new SeedRepository($this->getConnection());
        }
        
        public function getCartRepository()
        {
            return new CartRepository($this->getConnection());
        }

        public function getSellerRepository()
        {
            return new SellerRepository($this->getConnection());
        }
    }

?>