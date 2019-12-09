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

        public function add($seller)
        {
            $stmt = $this->conn->prepare(
                "INSERT INTO Sellers 
                    (UserId,Age,CPF,Email,DateOfBirth,WebSite,Company,CNPJ,BranchOfActivity,FantasyName) 
                values 
                    (:UserId,:Age,:CPF,:Email,:DateOfBirth,:WebSite,:Company,:CNPJ,:BranchOfActivity,:FantasyName)"
            );
            $stmt->bindValue(':UserId', $seller->getUserId());
            $stmt->bindValue(':Age', $seller->getAge());
            $stmt->bindValue(':CPF', $seller->getCpf());
            $stmt->bindValue(':Email',$seller->getEmail());
            $stmt->bindValue(':DateOfBirth',$seller->getDateOfBirth());
            $stmt->bindValue(':WebSite', $seller->getWebSite());
            $stmt->bindValue(':Company',$seller->getCompany());
            $stmt->bindValue(':CNPJ', $seller->getCnpj());
            $stmt->bindValue(':BranchOfActivity',  $seller->getBranchOfActivity());
            $stmt->bindValue(':FantasyName', $seller->getFantasyName());
            if(!$stmt->execute()){
                print_r($stmt->errorInfo());
                exit();
            }

            //echo '<pre>'; var_dump($seller);echo '</pre>';exit();

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
                        s.SellerId, u.Name as Name, u.LastName as LastName, s.Company as Company, 
                        s.FantasyName as FantasyName,  u.Login as Login, u.userId as userId
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
                        s.SellerId, u.Name as Name, u.LastName as LastName, s.Company as Company, 
                        s.FantasyName as FantasyName,  u.Login as Login, u.userId as userId
                    from Users u
                    inner join Sellers s on u.userid = s.userid
                    where 
                        u.role = 'vendedor' and 
                        (
                            u.login like :search or 
                            u.name like :search or 
                            u.LastName like :search or                             
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
                    $row["Login"],
                    $row["userId"]
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

        public function getById($sellerId)
        {
            $stmt = $this->conn->prepare(
                "SELECT 
                    s.SellerId as SellerId, u.Name as Name, u.LastName as LastName, s.Company as Company, 
                    s.FantasyName as FantasyName, u.Login as Login, u.userId as userId
                from Users u
                inner join Sellers s on u.userid = s.userid
                where  s.sellerId = :sellerId limit 1 " 
            );
            $stmt->bindValue(":sellerId", $sellerId);
            $stmt->execute();
            $sellerResult = $stmt->fetch();

            $seller = null;
            if (isset($sellerResult)){
                $seller = new Seller(
                    $sellerResult["SellerId"],
                    $sellerResult["Name"],
                    $sellerResult["LastName"],
                    $sellerResult["Company"],
                    $sellerResult["FantasyName"], 
                    $sellerResult["Login"],
                    $sellerResult["userId"]
                );
            }
            return $seller;
        }

        public function addSimplifiedSeller($seller)
        {
            $stmt = $this->conn->prepare(
                "INSERT INTO Sellers (userId) 
                values 
                (:userId)"
            );
            $stmt->bindValue(':userId', $userId);
            $stmt->execute();
        }

        public function remove($sellerId)
        {
            $seller = $this->getById($sellerId);
            
            if (isset($seller)) {
                $userId = $seller->getUserId();
                $stmt = $this->conn->prepare(
                    "delete from sellers where sellerId = :sellerId"
                );
                $stmt->bindValue(":sellerId", $sellerId);
                $stmt->execute();
                
                //removendo o endereço
                $stmt = $this->conn->prepare(
                    "delete from address where userId = :userId"
                );
                $stmt->bindValue(":userId", $userId);
                $stmt->execute();

                //removendo itens de pedido
                $stmt = $this->conn->prepare(
                    "delete from orderitens where productid in (select productid from products where userid = :userId);"
                );
                $stmt->bindValue(":userId", $userId);
                $stmt->execute();

                //removendo pedidos
                $stmt = $this->conn->prepare(
                    "delete from orders where userid = :userId);"
                );
                $stmt->bindValue(":userId", $userId);
                $stmt->execute();

                //removendo produtos
                $stmt = $this->conn->prepare(
                    "delete from products where userid = :userId;"
                );
                $stmt->bindValue(":userId", $userId);
                $stmt->execute();

                //removendo usuario
                $stmt = $this->conn->prepare(
                    "delete from users where userid = :userId;"
                );
                $stmt->bindValue(":userId", $userId);
                $stmt->execute();
            }
        }
    }