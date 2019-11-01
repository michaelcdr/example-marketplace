<?php

    namespace infra\repositories;    
    use infra\MySqlRepository;
    use infra\interfaces\ICartRepository;
    use PDO;

    class CartRepository extends MySqlRepository implements ICartRepository 
    {
        public function addProduct($productId,$cart)
        {
            //echo "<br>addProduct";
            $qtd = $this->getQtdProduct($productId,$cart);
            //echo "qtd: " . $qtd;
            if ($qtd == 0)
            {
                echo "<br>inserindo";
                echo "<br>productId:". $productId ;
                echo "<br>CartGroup:". $cart ;
                $stmt = $this->conn->prepare(
                    "INSERT INTO Carts (ProductId, CartGroup, Qtd, CreatedAt)  values (:ProductId, :CartGroup, :Qtd, now())"
                );
                $stmt->bindValue(':ProductId', $productId);
                $stmt->bindValue(':CartGroup', $cart);
                $stmt->bindValue(':Qtd', 1);
                $stmt->execute();
                
            } 
            else 
            { 
                echo "<br>atualizando";
                $qtd += 1;
                $stmt = $this->conn->prepare(
                    "UPDATE Carts SET
                    Qtd = :Qtd where ProductId = :ProductId and CartGroup = :CartGroup"
                );
                $stmt->bindValue(':ProductId', $productId);
                $stmt->bindValue(':CartGroup', $cart);
                $stmt->bindValue(':Qtd', $qtd);
                $stmt->execute();
            }
        }

        public function getQtdProduct($productId, $cart)
        {
            $qtd = 0;
            $stmt = $this->conn->prepare(
                "select qtd from Carts where CartGroup = :CartGroup and ProductId = :ProductId;"
            );
            $stmt->bindValue(':ProductId', $productId);
            $stmt->bindValue(':CartGroup', $cart);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($row) 
                $qtd = $row['qtd'];
            
            return $qtd;
        }

     
    }

?>