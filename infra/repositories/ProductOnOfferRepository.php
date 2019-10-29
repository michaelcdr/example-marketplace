<?php
    namespace infra\repositories;
    
    use infra\MySqlRepository;
    use infra\interfaces\IProductOnOfferRepository;
    class ProductOnOfferRepository 
        extends MySqlRepository 
        implements IProductOnOfferRepository
    { 
        public function getAll()
        {
            $query = "select pf.ProductId, pf.Price, pf.Title, pf.Description, (
                select pi.filename from ProductsImages pi where pi.productid = pf.productid limit 1
            ) as Image
            from Products pf where pf.offer = 1;";
            $stmt = $this->conn->query($query);
            $lista = $stmt->fetchAll();
            
            return $lista;
        }
        
        public function getById($id)
        {
            //echo 'getById<br />';            
            $query = "SELECT ProductId, Title, Price FROM Products where ProductId = ? " ;
            $stmt = $this->conn->prepare( $query );
            $stmt->bindParam(1, $id);
            $stmt->execute();         
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            //print_r($row);

            if ($row) {
                return new ProductOffer($row['ProductId'],$row['Title'],$row['Price']);
            }
            return null;
        }
    }
?>