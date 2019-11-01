<?php
namespace models;

class CartViewModel
{
    private $total;
    private $products;
    
    public function __construct($products, $total)
    {
      
        $this->total = $total;
        $this->products = $products;
    }

    /**
     * Get the value of total
     */ 
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Get the value of products
     */ 
    public function getProducts()
    {
        return $this->products;
    }

    public function addProduct($product){
        echo "chego";
        
        if (!is_null($this->getProducts())){
            foreach ($this->getProducts() as $productItem){
                var_dump($product->getId());
                if ($product->getId() ==  $productItem->getProductId()){
                    $productItem->incrementQtd(); 
                }
            }
        } else
            array_push($this->getProducts(),$product);

    }
}