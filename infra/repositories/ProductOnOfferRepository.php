<?php
    namespace infra\repositories;
    
    use infra\MySqlRepository;
    use infra\interfaces\IProductOnOfferRepository;
    //require_once './infra/interfaces/IProductOnOfferRepository.php';
    //require_once './infra/MySqlRepository.php';
    //require_once './models/ProductOffer.php';

    class ProductOnOfferRepository 
        extends MySqlRepository 
        implements IProductOnOfferRepository
    { 
        public function getAll()
        {
            $query = "select p.ProductId, pf.Price, p.Title, p.Description, (
                select pi.filename from ProductsImages pi where pi.productid = p.productid limit 1
            ) as Image
            from ProductsOnOffer pf 
            inner join Products p on pf.productid = p.productid;";
            $resultado = $this->conn->query($query);
            $lista = $resultado->fetchAll();
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