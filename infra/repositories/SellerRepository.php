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

        public function getAllPaginated() 
        {
            $this->conn->prepare(
                "select u.userid, u.login, u.name, u.role, s.sellerid,s.age,s.cpf,s.cep,
                s.neighborhood,s.email,s.dateofbirth,s.website,s.city,s.company,
                s.cnpj,s.branchofactivity,s.fantasyname,s.stateid
                from users u
                inner join sellers s on u.userid = s.userid
                where u.role= 'vendedor'"
            );
        }
    }