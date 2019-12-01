<?php

    namespace infra\repositories;    
    use infra\MySqlRepository;
    use infra\interfaces\IOrderRepository;
    use models\Order;
    use models\OrderItem;
    use models\PaginatedResults;
    use PDO;

    
    class OrderRepository 
        extends MySqlRepository 
        implements IOrderRepository
    {
        public function add($order)
        {
            $stmt = $this->conn->prepare(
                "INSERT INTO orders
                (
                    total,createdat,userid,stateid,cardownername,
                    expirationdate,name,address,neighborhood,cep,city,cpf
                )
                values
                (
                    :total,now(),:userId,:stateId,:cardOwner,
                    :expirationDate,:name,:address,:neighborhood,:cep,:city,:cpf
                );"
            );
            $stmt->bindValue(':total', $order->getTotal());
            $stmt->bindValue(':userId', $order->getUserId());
            $stmt->bindValue(':stateId', $order->getStateId());
            $stmt->bindValue(':cardOwner', $order->getCardOwner());
            $stmt->bindValue(':expirationDate', $order->getExpirationDate());
            $stmt->bindValue(':name', $order->getName());
            $stmt->bindValue(':address', $order->getAddress());
            $stmt->bindValue(':neighborhood', $order->getNeighborhood());
            $stmt->bindValue(':cep', $order->getCep());
            $stmt->bindValue(':city', $order->getCity());
            $stmt->bindValue(':cpf', $order->getCpf());
            $stmt->execute();
            
            $orderId = $this->conn->lastInsertId();

            foreach($order->getOrderItens() as $item)
            {
                $stmt = $this->conn->prepare(
                    "insert into orderitens(orderid, productid, qtd) 
                    values(
                        :orderId, :productId, :qtd
                    )"
                );
                $stmt->bindValue(':orderid', $item->getOrderId());
                $stmt->bindValue(':productid', $item->getProductId());
                $stmt->bindValue(':qtd', $item->getQtd());
                $stmt->execute();
            }
            
            return $orderId;
        }



        public function getById($orderId)
        {
            $stmt = $this->conn->prepare(
                "SELECT orderId, total, name 
                 FROM Orders
                 WHERE orderId = :orderId LIMIT 1"
            );
            $stmt->bindValue(':orderId', $orderId);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row) 
                $usuario = new Order(
                    $row['orderId'], 
                    $row['total'], 
                    $row['name']
                );
          
            return $usuario;
        }



        public function total($search)
        {
            if (is_null($search) ||  $search === "")
            {
                $stmt = $this->conn->prepare(
                    "SELECT count(UserId) as total FROM Users "
                );
                $stmt->execute();
                $total = $stmt->fetch();
                return intval($total["total"]);
            }
            else
            {
                $stmt = $this->conn->prepare( 
                    "SELECT count(UserId) as total FROM Users 
                     WHERE Login like :search or Name like :search" 
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
                    "SELECT UserId, Login, Name, Role 
                     FROM Users limit :pageSize OFFSET :skipNumber "
                );
                $stmt->bindValue(':pageSize', intval(trim($pageSize)), PDO::PARAM_INT);
                $stmt->bindValue(':skipNumber', intval(trim($skipNumber)), PDO::PARAM_INT);
                $stmt->execute();
                $usersResults = $stmt->fetchAll();
            }
            else
            {
                $stmt = $this->conn->prepare( 
                    "SELECT UserId, Login, Name, Role FROM Users 
                     WHERE Login like :search or 
                     Name like :search order by name 
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
            
            $paginatedReesults = new PaginatedResults(
                $usersResults, 
                $total, 
                count($usersResults),
                $hasPreviousPage,
                $hasNextPage,
                $page,
                $numberOfPages,
                "/admin/usuario?p="
            );


            

            return $paginatedReesults;
        }
    }

?>