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
            echo '<pre>';
            var_dump($user);
            echo '</pre>';
            $query = "INSERT INTO Users (Login, Password, Name) values " . 
            "('". $user->getLogin() . "','" . $user->getPassword()."','".$user->getName()."') ";
            
            $this->conn->exec($query);
        }

        public function remove($user){

        }

        public function altera($user){

        }

        public function getById($id){
            
        }

        public function getByLogin($login){

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