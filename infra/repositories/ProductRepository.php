<?php
    namespace infra\repositories;
    use infra\MySqlRepository;    
    use infra\interfaces\IProductRepository;
    use models\Product;
    use models\PaginatedResults;
    use PDO;

    class ProductRepository 
        extends MySqlRepository  
        implements IProductRepository
    {
        public function totalOfProducts($search)
        {
            $stmt = null;
            if (is_null($search) ||  $search === "")
            {
                $stmt = $this->conn->prepare(
                    "SELECT count(p.ProductId) as total FROM Products p"
                );
            }
            else 
            {
                $stmt = $this->conn->prepare(
                    "SELECT count(p.ProductId) as total FROM Products p
                    where 
                        p.title like :search or
                        p.description like :search or
                        p.Sku like :search"
                );
                $stmt->bindValue(":search", '%' . $search . '%');
            }
            $stmt->execute();
            $total = $stmt->fetch();
            return intval($total["total"]);
        }

        public function getAll($page, $search)
        {
            $skipNumber = 0;
            $pageSize = 5;
            // echo "pagina: " . $page . "<br>";
            if (!is_null($page) && $page > 0)
                $skipNumber = $pageSize * ($page - 1);
            // echo "skipNumber: " . $skipNumber . "<br>";

            $stmt = null;
            $total = $this->totalOfProducts($search);
            
            if (is_null($search) ||  $search === "")
            {
                $stmt = $this->conn->prepare(
                    "SELECT p.ProductId, p.Title, p.Price, p.Description, p.CreatedAt, 
                            p.CreatedBy, p.Offer, p.Stock, p.Sku, Image.filename as ImageFileName,
                            p.UserId, u.Name as Seller
                            FROM Products p
                    inner join users u on p.userid = u.userid
                    left join (
                        select pi.ProductId, pi.filename as filename
                        from ProductsImages pi     
                    )
                    as Image on p.ProductId = Image.ProductId 
                    group by p.productid 
                    order by p.title
                    limit :pageSize OFFSET :skipNumber "
                );
            }
            else 
            {
                $stmt = $this->conn->prepare(
                    "SELECT p.ProductId, p.Title, p.Price, p.Description, p.CreatedAt, 
                            p.CreatedBy, p.Offer, p.Stock, p.Sku, Image.filename as ImageFileName,
                            p.UserId, u.Name as Seller
                            FROM Products p
                    inner join users u on p.userid = u.userid
                    left join (
                        select pi.ProductId, pi.filename as filename
                        from ProductsImages pi     
                    )
                    as Image on p.ProductId = Image.ProductId 
                    where 
                        p.title like :search or
                        p.description like :search or
                        p.Sku like :search
                    group by productid 
                    order by p.title 
                    limit :pageSize OFFSET :skipNumber "
                );
                $stmt->bindValue(":search", '%' . $search . '%');
            }

            $stmt->bindValue(':pageSize', intval(trim($pageSize)), PDO::PARAM_INT);
            $stmt->bindValue(':skipNumber', intval(trim($skipNumber)), PDO::PARAM_INT);
            $stmt->execute();
            $produtosResult = $stmt->fetchAll();
            
            $numberOfPages = ceil($total / $pageSize);
            $hasPreviousPage = false;
            if ($numberOfPages > 1 && $page > 1)
                $hasPreviousPage = true;

            $hasNextPage = false;
            if ($numberOfPages > intval($page))
                $hasNextPage = true;
            
            return new PaginatedResults(
                $produtosResult, 
                $total, 
                count($produtosResult),
                $hasPreviousPage,
                $hasNextPage,
                $page,
                $numberOfPages
            );
        }

        public function add($product)
        {
            $stmt = $this->conn->prepare(
                "INSERT INTO products(Title, Description, Price, CreatedAt, CreatedBy, Offer, Stock, Sku) 
                values (:title, :desc, :price, now(), :createdBy, :offer, :stock,:sku);"
            );
            
            $stmt->bindValue(":title",$product->getTitle());
            $stmt->bindValue(":desc",$product->getDescription());
            $stmt->bindValue(":price",$product->getPrice());
            $stmt->bindValue(":createdBy",$product->getCreatedBy());
            $stmt->bindValue(":offer",$product->getOffer() == 'true' ? 1 : 0, PDO::PARAM_BOOL);
            $stmt->bindValue(":stock",$product->getStock());
            $stmt->bindValue(":sku",$product->getSku());
            $stmt->execute();
            return $this->conn->lastInsertId();
        }

        public function addImages($productId, $imagesNames)
        {
            foreach($imagesNames as $image)
            {
                $stmt = $this->conn->prepare(
                    "INSERT INTO productsimages(ProductId, FileName) 
                    values (:ProductId, :FileName);"
                );
                $stmt->bindValue(":ProductId",$productId);
                $stmt->bindValue(":FileName",$image);
                $stmt->execute();
            }
        }

        /*
         * removendo imagens do produto;
         */
        public function removeAllImages($productId)
        {  
            $stmt = $this->conn->prepare("delete from productsimages where productid = :id");
            $stmt->bindValue(':id', $productId);
            $stmt->execute();
        }

        public function remove($id)
        {
            $this->removeAllImages($id);

            //removendo produtos...
            $stmt = $this->conn->prepare("delete from products where productid = :id");
            $stmt->bindValue(':id', $id);
            $stmt->execute();

            return true;
        }

        public function update($product)
        {
            $stmt = $this->conn->prepare(
                "UPDATE Products set 
                title = :title,
                description = :description,
                offer = :offer,
                stock = :stock,
                sku = :sku
                where ProductId = :productId"
            );
            
            $stmt->bindValue(":title", $product->getTitle());
            $stmt->bindValue(":description", $product->getDescription());
            $stmt->bindValue(":offer",$product->getOffer() == 'true' ? 1 : 0, PDO::PARAM_BOOL);
            $stmt->bindValue(":stock", $product->getStock());
            $stmt->bindValue(":sku", $product->getSku());
            $stmt->bindValue(":productId", $product->getId());
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
                "SELECT p.ProductId, p.Title, p.Description, p.Price, 
                        p.CreatedAt, p.CreatedBy, p.Offer, p.Stock, p.Sku,
                         p.UserId  , u.name as Seller
                FROM Products p
                inner join users u on p.userid = u.userid
                WHERE p.ProductId = :ProductId"
            );
            $stmt->bindValue(":ProductId",$id);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $product = null;

            if ($row)
            {
                $product = new Product(
                    $row['ProductId'], 
                    $row['Title'], 
                    $row['Price'], 
                    $row['Description'], 
                    $row['CreatedAt'], 
                    $row['CreatedBy'],
                    $row['Offer'],
                    $row['Stock'],
                    $row['Sku'],
                    $row['UserId'],
                    $row["Seller"]
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