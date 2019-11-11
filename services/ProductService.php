<?php
    namespace services;

    use models\Product;
    use models\helpers\PathHelper;
    
    class ProductService 
    {
        private $_repoProduct;
        private $_pathHelper;

        public function __construct($factory)
        {
            $this->_repoProduct = $factory->getProductRepository();
            $this->_pathHelper = new PathHelper();
        }

        public function getAllPaginatedAdmin($pagina)
        {
            $stmtProdutosResult = $this->_repoProduct->getAll(0, null);
            $products = $this->stmtToProduct($stmtProdutosResult);
            return $products;
        }

        public function add($files, $product)
        {
             //uplodeando arquivos informados pelo usuario...
             if (isset($files))
             {                        
                $totalFiles = count($files);
                // echo '<br>total: ' . $totalFiles;
                // echo "<br>***********************************";
                for ($i=0 ; $i < $totalFiles ; $i++ ) {
                    if (isset($files["name"][$i])){
                        //echo '<br>item: ' . $i ;
                        $fileName = basename($files["name"][$i]); 
                        $targetFilePath = 'img/products/' . $fileName; 
                        // echo '<br>diretorio: ' . $targetFilePath;
                        //obtendo extensao...
                        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
                        // echo '<br>extensao: ' . $fileType;
                        move_uploaded_file($files["tmp_name"][$i], $targetFilePath);
                        // echo "<br>***********************************";
                    }
                }
            }
            
            //persistindo produto...
            $this->_repoProduct->add($product);
        }

        public function stmtToProduct($produtosResult)
        {
            $products = array();
            foreach($produtosResult as $productItem){
               $product = new Product(
                    $productItem["ProductId"],
                    $productItem["Title"],
                    $productItem["Price"],
                    $productItem["Description"],
                    $productItem["CreatedAt"],
                    $productItem["CreatedBy"],
                    $productItem["Offer"],
                    $productItem["Stock"],
                    $productItem["Sku"]
                );
                $product->setDefaultImage(
                    $this->_pathHelper->getPathImgProduct() . $productItem["ImageFileName"]
                );
                $products[] = $product;
            }
            
            return $products;
        }
    }