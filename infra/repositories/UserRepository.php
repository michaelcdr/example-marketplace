<?php

    namespace infra\repositories;    
    use infra\MySqlRepository;
    use infra\interfaces\IUserRepository;
    use models\User;
    use PDO;

    class UserRepository 
        extends MySqlRepository 
        implements IUserRepository 
    {
        public function add($user)
        {
            $stmt = $this->conn->prepare("INSERT INTO Users (Login, Password, Name) values (:loginParam,:passwordParam, :nameParam)");
            $stmt->bindValue(':loginParam', $user->getLogin());
            $stmt->bindValue(':passwordParam', password_hash($user->getPassword(), PASSWORD_ARGON2I));
            $stmt->bindValue(':nameParam',$user->getName());
            $stmt->execute();
        }

        public function remove($id)
        {
            $query = "delete from Users where UserId = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id);

            // execute the query
            if ($stmt->execute())
                return true;
        }

        public function altera($user)
        {
            // echo '<pre>';
            // echo $user->getUserId() . ', ' . $user->getName() . ', ' . $user->getLogin();
            // echo '</pre>';
            // exit();
            $stmt = $this->conn->prepare(
                "UPDATE Users set login = :loginParam, name = :nameParam
                 where UserId = :userId");
            
            $stmt->bindValue(':userId', $user->getUserId());
            $stmt->bindValue(':loginParam', $user->getLogin());
            $stmt->bindValue(':nameParam', $user->getName());
            $stmt->execute();
        }

        public function getById($id)
        {
            $stmt = $this->conn->prepare(
                "SELECT UserId, Login, Name, Password FROM Users 
                 WHERE UserId = :UserId LIMIT 1"
            );
            $stmt->bindValue(':UserId', $id);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row) 
                $usuario = new User($row['UserId'], $row['Login'], $row['Password'], $row['Name']);
          
            return $usuario;
        }

        public function getByLogin($login)
        {
            $usuario = null;
            $stmt = $this->conn->prepare(
                "SELECT UserId, Login, Name, Password FROM Users 
                 WHERE login = :login LIMIT 1"
            );
            $stmt->bindValue(':login', $login);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row) 
                $usuario = new User($row['UserId'], $row['Login'], $row['Password'], $row['Name']);
          
            return $usuario;
        }

        public function getAll($page, $search)
        {
            $skipNumber = 0;
            $pageSize = 5;
            if (!is_null($page) && $page > 0)
                $skipNumber = $skipNumber * $page;

            if (!isset($page))
                $page = 0;

            if (is_null($search) ||  $search === "")
            {
                //echo 'Lista sem pesquisa';
                $stmt = $this->conn->prepare(
                    "SELECT UserId, Login, Name 
                     FROM Users limit :pageSize OFFSET :skipNumber "
                );
                //$stmt->bindParam(1, intval(trim($pageSize)), PDO::PARAM_INT); //erro ocorrido Only variables should be passed by reference
                $stmt->bindValue(':pageSize', intval(trim($pageSize)), PDO::PARAM_INT);
                $stmt->bindValue(':skipNumber', intval(trim($skipNumber)), PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetchAll();
            }
            else
            {
                $stmt = $this->conn->prepare( 
                    "SELECT UserId, Login, Name FROM Users 
                     WHERE Login like :search or 
                     Name like :search order by name 
                     limit :pageSize OFFSET :skipNumber 
                    " 
                );
                
                $stmt->bindValue(":search", '%' . $search . '%');
                $stmt->bindValue(':pageSize', intval(trim($pageSize)), PDO::PARAM_INT);
                $stmt->bindValue(':skipNumber', intval(trim($skipNumber)), PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetchAll();
            }            
        }
    }

?>