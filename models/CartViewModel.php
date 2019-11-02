<?php
namespace models;

class CartViewModel
{
    private $total;
    private $products;
    private $cartGroup;
    public function __construct($cartGroup,$products, $total)
    {
        $this->cartGroup = $cartGroup;
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

    public function getCartGroup()
    {
        return $this->cartGroup;
    }

    public function removeProduct($productId)
    {
        
    }
    
    public function addProduct($product)
    {
        if (!is_null($this->getProducts()))
        {
            //ja tem produtos...
            $existe = false;
            foreach ($this->getProducts() as $productItem)
            {
                if ($product->getProductId() ==  $productItem->getProductId())
                {
                    $productItem->incrementQtd(); 
                    $existe = true;
                } 
            }

            if (!$existe)
                $this->products[] = $product;
        }
    }
}