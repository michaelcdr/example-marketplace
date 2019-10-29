<?php

    namespace infra\repositories;    
    use infra\MySqlRepository;
    use infra\interfaces\ICartRepository;
    use PDO;

    class CartRepository extends MySqlRepository implements ICartRepository 
    {
        public function addProduct($productId,$cartId)
        {
            //echo "<br>addProduct";
            //$qtd = $this->getQtdProduct($productId,$cartId);
            //echo "qtd: " . $qtd;
            
                echo "<br>inserindo";
                echo "<br>productId:". $productId ;
                echo "<br>cartId:". $cartId ;
                $stmt = $this->conn->prepare(
                    "INSERT INTO Carts (ProductId, CartId, Qtd, CreatedAt)  values (:ProductId, :CartId, :Qtd, now())"
                );
                $stmt->bindValue(':ProductId', $productId);
                $stmt->bindValue(':CartId', $cartId);
                $stmt->bindValue(':Qtd', 1);
                $stmt->execute();
            //     if ($qtd == 0)
            // {
                
            // } 
            // else 
            // { 
            //     echo "<br>atualizando";
            //     $qtd += 1;
            //     $stmt = $this->conn->prepare(
            //         "UPDATE Carts SET
            //         Qtd = :Qtd where ProductId = :ProductId and CartId = :CartId"
            //     );
            //     $stmt->bindValue(':ProductId', $productId);
            //     $stmt->bindValue(':CartId', $cartId);
            //     $stmt->bindValue(':Qtd', $qtd);
            //     $stmt->execute();
            // }
        }

        public function getQtdProduct($productId, $cartId)
        {
            $qtd = 0;
            $stmt = $this->conn->prepare(
                "select qtd from Carts where CartId = :CartId and ProductId = :ProductId;"
            );
            $stmt->bindValue(':ProductId', $productId);
            $stmt->bindValue(':CartId', $cartId);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            var_dump($row);
            if ($row) 
                $qtd = $row['qtd'];
            
            return $qtd;
        }

     
    }

?>