<?php

    namespace infra\repositories;    

    use infra\MySqlRepository;
    use infra\interfaces\ISellerRepository;
    use models\Seller;
    use models\PaginatedResults;
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

        public function total($search)
        {
            if (is_null($search) || $search === "")
            {
                $stmt = $this->conn->prepare(
                    "SELECT count(SellerId) as total FROM Sellers "
                );
                $stmt->execute();
                $total = $stmt->fetch();
                return intval($total["total"]);
            }
            else
            {
                $stmt = $this->conn->prepare( 
                    "SELECT count(s.SellerId) total 
                    from Users u
                    inner join Sellers s on u.userid = s.userid
                    where 
                        u.role ='vendedor' and 
                        (
                            u.login like :search or 
                            u.name like :search or 
                            s.LastName like :search or 
                            s.City like :search or 
                            s.Company like :search or 
                            s.FantasyName like :search 
                        )" 
                );
                $stmt->bindValue(":search", '%' . $search . '%');
                $total = $stmt->fetch();
                return intval($total["total"]);
            }  
        }

        public function getAll($page, $search, $pageSize)
        {
            //configurando variaveis para paginação
            if (!isset($page))
                $page = 0;
            
            if (!isset($pageSize))
                $pageSize = 5;  
            
            $skipNumber = 0;
            if (!is_null($page) && $page > 0)
                $skipNumber = $pageSize * ($page - 1);
            
            $total = $this->total($search);
            //echo "page: " . $page . "<br/> skipNumber: " . $skipNumber . "<br/>";

            //obtendo lista de usuarios...
            $usersResults = null;
            if (is_null($search) ||  $search === "")
            {
                $stmt = $this->conn->prepare(
                    "SELECT 
                    s.SellerId, u.Name, s.LastName, s.Company, 
                    s.FantasyName, s.City ,u.Login
                    from Users u
                    inner join Sellers s on u.userid = s.userid
                    where u.role = 'vendedor'
                    limit :pageSize OFFSET :skipNumber "
                );
                $stmt->bindValue(':pageSize', intval(trim($pageSize)), PDO::PARAM_INT);
                $stmt->bindValue(':skipNumber', intval(trim($skipNumber)), PDO::PARAM_INT);
                $stmt->execute();
                $usersResults = $stmt->fetchAll();
            }
            else
            {
                $stmt = $this->conn->prepare( 
                    "SELECT 
                        s.SellerId, u.Name, s.LastName, s.Company, 
                        s.FantasyName, s.City, u.Login 
                    from Users u
                    inner join Sellers s on u.userid = s.userid
                    where 
                        u.role = 'vendedor' and 
                        (
                            u.login like :search or 
                            u.name like :search or 
                            s.LastName like :search or 
                            s.City like :search or 
                            s.Company like :search or 
                            s.FantasyName like :search 
                        ) 
                     limit :pageSize OFFSET :skipNumber " 
                );
                $stmt->bindValue(":search", '%' . $search . '%');
                $stmt->bindValue(':pageSize', intval(trim($pageSize)), PDO::PARAM_INT);
                $stmt->bindValue(':skipNumber', intval(trim($skipNumber)), PDO::PARAM_INT);
                $stmt->execute();
                $usersResults = $stmt->fetchAll();
            }   
            
            //obtendo dados para controle da paginação
            $numberOfPages = ceil($total / $pageSize);
            $hasPreviousPage = false;
            if ($numberOfPages > 1 && $page > 1)
                $hasPreviousPage = true;

            $hasNextPage = false;
            if ($numberOfPages > intval($page))
                $hasNextPage = true;

            $sellers = array();
            foreach($usersResults as $row){
                //echo $row["Login"];
                $sellers[] = new Seller(
                    $row["SellerId"],
                    $row["Name"],
                    $row["LastName"],
                    $row["Company"],
                    $row["FantasyName"],
                    $row["City"],
                    $row["Login"],
                    $seller["userId"]
                );
            }


            $paginatedResults = new PaginatedResults(
                $sellers, 
                $total, 
                count($sellers),
                $hasPreviousPage,
                $hasNextPage,
                $page,
                $numberOfPages,
                "/admin/vendedor?p="
            );

            return $paginatedResults;
        }
    }