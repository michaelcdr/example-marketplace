<?php
    namespace infra\repositories;    
    use infra\MySqlRepository;
    use infra\interfaces\ICategoryRepository;
    use PDO;
    use models\Category;

    class CategoryRepository extends MySqlRepository implements ICategoryRepository
    {
        public function getAll($page, $search)
        {
            $stmt = $this->conn->prepare("SELECT CategoryId, Title, Image FROM Categories");
            $stmt->execute();
            $lista = $stmt->fetchAll();
            
            return $lista;
        }

        public function add($category)
        {
            $stmt = $this->conn->prepare(
                "INSERT INTO Categories (title, image) 
                    values (:title, :image) "
            );
            $stmt->bindValue(":title",$category->getTitle());
            $stmt->bindValue(":image",$category->getImage());
            $stmt->execute();
        }
    }
?>