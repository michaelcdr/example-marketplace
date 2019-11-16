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
        function getAll($page, $search)
        {
            $skipNumber = 0;
            $pageSize = 5;
            if (!is_null($page) && $page > 0)
                $skipNumber = $skipNumber * $page;

            if (!isset($page))
                $page = 0;

            $stmt = null;

            
            if (is_null($search) ||  $search === "")
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
                    group by p.productid 
                    order by p.title
                    limit :pageSize OFFSET :skipNumber "
                );
            }
            else 
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

            return $produtosResult;
        }

        function add($product)
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

        public function remove($id)
        {
            //removendo imagens do produto;
            $stmt = $this->conn->prepare("delete from productsimages where productid = :id");
            $stmt->bindValue(':id', $id);
            $stmt->execute();

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