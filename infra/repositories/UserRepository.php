<?php

    namespace infra\repositories;    
    use infra\MySqlRepository;
    use infra\interfaces\IUserRepository;
    
    use PDO;

    class UserRepository 
        extends MySqlRepository 
        implements IUserRepository 
    {
        public function add($user)
        {
            $query = "INSERT INTO Users (Login, Password, Name) values " . 
            "('". $user->getLogin() . "','" . $user->getPassword()."','".$user->getName()."') ";
            
            $this->conn->exec($query);
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

        }

        public function getById($id)
        {
            $query = "INSERT INTO Users (Login, Password, Name) values " . 
            "('". $user->getLogin() . "','" . $user->getPassword()."','".$user->getName()."') ";
            
            $this->conn->exec($query);
        }

        public function getByLogin($login)
        {
            $usuario = null;
            $query = "SELECT UserId, Login, Name FROM Users " . 
            "WHERE login = ? LIMIT 1 OFFSET 0";
             
            $stmt = $this->conn->prepare( $query );
            $stmt->bindParam(1, $login);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($row) 
                $usuario = new Usuario($row['id'],$row['login'], $row['senha'], $row['nome']);
            
            return $usuario;
        }

        public function getAll($page, $skip,$take)
        {
            $query = "SELECT UserId, Login, Name FROM Users";
            $resultado = $this->conn->query($query);
            $lista = $resultado->fetchAll();
            return $lista;
        }
    }

?>