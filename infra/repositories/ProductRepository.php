<?php
    namespace infra\repositories;
    use infra\MySqlRepository;    
    use infra\interfaces\IProductRepository;
    use models\Product;
    use PDO;

    class ProductRepository extends MySqlRepository  implements IProductRepository
    {
        function getAll($page, $skip)
        {
            $stmt = $this->conn->prepare(
                "SELECT ProductId, Title, Description, CreatedAt, CreatedBy, 
                Offer, Stock, Sku  
                FROM Products"
            );
            $stmt->execute();
            return $stmt->fetchAll();
        }

        function add($product)
        {
            $stmt = $this->conn->prepare(
                "INSERT INTO Products(title, description, createdAt, createdBy,Offer, Stock, Sku) 
                values (:title, :description, now(), :createdBy, :offer, :stock, :sku) "
            );
            $stmt->bindValue(":title",$product->getTitle());
            $stmt->bindValue(":description",$product->getDescription());
            $stmt->bindValue(":createdBy",$product->getCreatedBy());
            $stmt->bindValue(":offer",$product->getOffer());
            $stmt->bindValue(":stock",$product->getStock());
            $stmt->bindValue(":sku",$product->getSku());

            return $stmt->fetchAll();
        }

        function getById($id)
        {
            $stmt = $this->conn->prepare(
                "SELECT ProductId, Title, Description, Price, 
                        CreatedAt, CreatedBy, Offer, Stock, Sku  
                FROM Products
                WHERE ProductId = :ProductId"
            );
            $stmt->bindValue(":ProductId",$id);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $product = null;

            if ($row){
                $product = new Product(
                    $row['ProductId'], 
                    $row['Title'], 
                    $row['Price'], 
                    $row['Description'], 
                    $row['CreatedAt'], 
                    $row['CreatedBy'],
                    $row['Offer'],
                    $row['Stock'],
                    $row['Sku']
                );

                $stmt = $this->conn->prepare(
                    "select * from productsimages where productid = :ProductId;"
                );
                $stmt->bindValue(":ProductId",$id);
                $stmt->execute();
                $images = $stmt->fetchAll();
                $product->setImages($images);
            }
            return $product;
        }
    }
?>