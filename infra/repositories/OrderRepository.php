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
            try{    
               
                $stmt = $this->conn->prepare(
                    "INSERT INTO orders
                    (
                        total, createdat, userId, stateId, cardOwnerName,
                        expirationDate, name, address, neighborhood, cep, 
                        city, cpf, complement
                    )
                    values
                    (
                        :total, now(), :userId, :stateId, :cardOwnerName,
                        :expirationDate,:name,:address,:neighborhood,:cep,:city,:cpf,:complement
                    );"
                );
                $stmt->bindValue(':total', $order->getTotal());
                $stmt->bindValue(':userId', intval($order->getUserId()));
                $stmt->bindValue(':stateId', intval($order->getStateId()));
                $stmt->bindValue(':cardOwnerName', $order->getCardOwner());
                $stmt->bindValue(':expirationDate', $order->getExpirationDate());
                $stmt->bindValue(':name', $order->getName());
                $stmt->bindValue(':address', $order->getAddress());
                $stmt->bindValue(':neighborhood', $order->getNeighborhood());
                $stmt->bindValue(':cep', $order->getCep());
                $stmt->bindValue(':city', $order->getCity());
                $stmt->bindValue(':cpf', $order->getCpf());
                $stmt->bindValue(':complement', $order->getComplement());
                $stmt->execute();

                // echo "chegou <br> total:" . $order->getTotal();
                // echo "<br> userId: " . $order->getUserId();
                // echo "<br> stateid: " . $order->getStateId();
                // echo "<br> cardOwner: " . $order->getCardOwner();
                // echo "<br> getExpirationDate: " . $order->getExpirationDate();
                // echo "<br> name: " . $order->getName();
                // echo "<br> getAddress: " . $order->getAddress();
                // echo "<br> getNeighborhood: " . $order->getNeighborhood();
                // echo "<br> getCep: " . $order->getCep();
                
                $orderId = $this->conn->lastInsertId();
                // echo $orderId;
                // echo "<pre>";
                // echo $order->getOrderItens();
                // echo "</pre>";
                foreach($order->getOrderItens() as $item)
                {
                    $stmt = $this->conn->prepare(
                        
                        "insert into orderitens(orderid,productid,qtd) 
                        values(
                            :orderId, :productId, :qtd
                        )"
                    );
                    $stmt->bindValue(':orderId', intval($orderId));
                    $stmt->bindValue(':productId', $item->getProductId());
                    $stmt->bindValue(':qtd', $item->getQtd());
                   // echo "orderId: ". $orderId . ", productid: " . $item->getProductId() .", qtd:" .$item->getQtd() . "<br>";
                    $stmt->execute();
                }
                
                return $orderId;
                
            }
            catch(PDOException $Exception){
                echo "erro " .  $Exception->getMessage();
                return null;
            }
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
                    "SELECT count(OrderId) as total FROM Orders "
                );
                $stmt->execute();
                $total = $stmt->fetch();
                return intval($total["total"]);
            }
            else
            {
                $stmt = $this->conn->prepare( 
                    "SELECT count(OrderId) as total FROM Orders 
                     WHERE 
                        CardOwnerName like :search or 
                        Name like :search or 
                        Address like :search or 
                        Complement like :search 
                        "
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
            $ordersResults = null;
            if (is_null($search) ||  $search === "")
            {
                $stmt = $this->conn->prepare(
                    "SELECT 
                        o.orderId as orderId,
                        o.userId as userId, 
                        o.total as total,
                        o.cardOwnerName as cardOwnerName,
                        s.stateId as stateId,
                        o.name as name, 
                        o.cep as cep, 
                        o.complement as complement,
                        o.address as address, 
                        o.neighborhood as neighborhood,
                        o.city as city,
                        o.createdAt as createdAt
                     FROM Orders o
                     left join states s on o.stateid = s.stateid
                     order by o.createdat desc
                     limit :pageSize OFFSET :skipNumber "
                );
                $stmt->bindValue(':pageSize', intval(trim($pageSize)), PDO::PARAM_INT);
                $stmt->bindValue(':skipNumber', intval(trim($skipNumber)), PDO::PARAM_INT);
                $stmt->execute();
                $ordersResults = $stmt->fetchAll();
            }
            else
            {
                $stmt = $this->conn->prepare( 
                    "SELECT o.orderId as orderId, 
                            o.userId as userId,
                            o.total as total,
                            o.cardOwnerName as cardOwnerName
                            o.name as name,
                            o.cep as cep,
                            o.address as address,
                            o.neighborhood,
                            o.city,
                            o.createdAt as createdAt
                     FROM Orders o
                     left join states s on o.stateid = s.stateid
                     WHERE 
                        o.Name like :search or 
                        o.City like :search or 
                        o.Address like :search or 
                        o.Complement like :search or
                        s.stateAbreviattion like :search 
                     order by o.createdat desc 
                     limit :pageSize OFFSET :skipNumber " 
                );
                $stmt->bindValue(":search", '%' . $search . '%');
                $stmt->bindValue(':pageSize', intval(trim($pageSize)), PDO::PARAM_INT);
                $stmt->bindValue(':skipNumber', intval(trim($skipNumber)), PDO::PARAM_INT);
                $stmt->execute();
                $ordersResults = $stmt->fetchAll();
            }   
            
            //obtendo dados para controle da paginação
            $numberOfPages = ceil($total / $pageSize);
            $hasPreviousPage = false;
            if ($numberOfPages > 1 && $page > 1)
                $hasPreviousPage = true;

            $hasNextPage = false;
            if ($numberOfPages > intval($page))
                $hasNextPage = true;
            
            $orders = array();
            foreach($ordersResults as $row)
            {
                $order =new Order(
                    $row["orderId"],
                    $row["userId"],
                    $row["total"],
                    $row["name"],
                    $row["cardOwnerName"],
                    null,
                    null,
                    null,
                    $row["cep"],
                    null,
                    $row["address"],
                    $row["neighborhood"],
                    $row["city"],
                    $row["stateId"],
                    $row["complement"],
                    null
                );
                $order->setCreatedAt($row["createdAt"]);
                $orders[] = $order;
            }
            
            $paginatedResults = new PaginatedResults(
                $orders, 
                $total, 
                count($orders),
                $hasPreviousPage,
                $hasNextPage,
                $page,
                $numberOfPages,
                "/admin/usuario/minhas-compras?p="
            );

            return $paginatedResults;
        }

        public function delete($id){
            $stmt = $this->conn->prepare(
                "delete from orderitens where orderId = :orderId"
            );
            $stmt->bindValue(':orderId', intval($id));
            $stmt->execute();

            $stmt = $this->conn->prepare(
                "delete from orders where orderId = :orderId"
            );
            $stmt->bindValue(':orderId', intval($id));
            $stmt->execute();
        }
    }

?>