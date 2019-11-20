<?php

    namespace infra\repositories;    

    use infra\MySqlRepository;
    use infra\interfaces\ISellerRepository;
    use models\Seller;
    use PDO;

    class SellerRepository 
        extends MySqlRepository 
        implements ISellerRepository 
    {

        public function addSimplifiedSeller($userId,$lastName)
        {
            $stmt = $this->conn->prepare(
                "INSERT INTO Sellers (userId, lastName) 
                values 
                (:userId, :lastName)"
            );
            $stmt->bindValue(':userId', $userId);
            $stmt->bindValue(':lastName', $lastName);
            $stmt->execute();
        }
    }