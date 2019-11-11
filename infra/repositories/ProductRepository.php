<?php
    namespace infra\repositories;
    use infra\MySqlRepository;    
    use infra\interfaces\IProductRepository;
    use models\Product;
    use PDO;

    class ProductRepository 
        extends MySqlRepository  
        implements IProductRepository
    {
        function getAll($page, $skip)
        {
            $stmt = $this->conn->prepare(
                "SELECT p.ProductId, p.Title, p.Price, p.Description, p.CreatedAt, 
                        p.CreatedBy, p.Offer, p.Stock, p.Sku, Image.filename as ImageFileName
                        FROM Products p
                left join (
                    select pi.ProductId, pi.filename as filename
                    from ProductsImages pi     
                )
                as Image on p.ProductId = Image.ProductId 
                group by productid"
            );
            // $stmt = $this->conn->prepare(
            //     "SELECT ProductId, Title, Price, Description, CreatedAt, CreatedBy, 
            //     Offer, Stock, Sku  
            //     FROM Products"
            // );
            $stmt->execute();
            $produtosResult = $stmt->fetchAll();

            return $produtosResult;
        }

        function add($product)
        {
            $stmt = $this->conn->prepare(
                "INSERT INTO products(Title, Description, Price, CreatedAt, CreatedBy, Offer, Stock, Sku) 
                values (:title, :desc, :price, :createdAt, :createdBy, :offer, :stock, :sku);"
            );
            

            $stmt->bindValue(":title",$product->getTitle());
            $stmt->bindValue(":desc",$product->getDescription());
            $stmt->bindValue(":price",$product->getPrice());
            $stmt->bindValue(":createdAt",date('Y/m/d H:i:s'));
            $stmt->bindValue(":createdBy",$product->getCreatedBy());
            $stmt->bindValue(":offer",$product->getOffer());
            $stmt->bindValue(":stock",$product->getStock());
            $stmt->bindValue(":sku",$product->getSku());
            $teste = $stmt->execute();
        }

        public function remove($id)
        {
            //removendo imagens do produto;
            $query = "delete from productsimages where productid = :id;";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            //removendo produtos...
            $query = "delete from Products where ProductId = :id";            
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id);
            
            return true;
        }

        public function altera($product)
        {
           
            $stmt = $this->conn->prepare(
                "UPDATE Products set 
                title = :title,
                description = :description,
                createdBy  = :createdBy,
                offer = :offer,
                stock = :stock,
                sku = :sku
                where ProductId = :productId"
            );
            
            $stmt->bindValue(":title",$product->getTitle());
            $stmt->bindValue(":description",$product->getDescription());
            $stmt->bindValue(":createdBy",$product->getCreatedBy());
            $stmt->bindValue(":offer",$product->getOffer());
            $stmt->bindValue(":stock",$product->getStock());
            $stmt->bindValue(":sku",$product->getSku());
            $stmt->execute();
        }

        /* Retorna o estoque de um produto */
        public function getCurrentStock($productId)
        {
            $stmt = $this->conn->prepare(
                "SELECT Stock FROM Products
                WHERE ProductId = :ProductId"
            );
            $stmt->bindValue(":ProductId",$productId);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $stock = 0;
            if ($row){
                $stock = $row['Stock'];
            }
            return $stock;
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