<?php
    namespace controllers;
    use infra;
    use infra\repositories;
    use models\User;
    use models\JsonSuccess;
    use models\JsonError;

    class UserController implements IBaseController
    {
        private $_repoUser;

        public function __construct($factory)
        {
            $this->_repoUser = $factory->getUserRepository();
        }
        
        public function proccessLoginRequest() : void
        {
            require "views/usuario/login.php";
        }

        public function proccessRequest() : void
        {
            require "views/usuario/login.php";
        }
        
        public function proccessLogoutRequest() 
        {
            if (isset($_SESSION["userId"])) {
                session_destroy();
                header("location: /");
                exit;
            } 
        }

        public function proccessLoginPostRequest() 
        {
            //session_start();
            //obtendo dados login...
            $login = filter_input(INPUT_POST,'login',FILTER_SANITIZE_STRING);
            $password = filter_input(INPUT_POST,'password',FILTER_SANITIZE_STRING);
            //echo "mostrando dados do post<br />";
            //echo "login: " . $_POST["login"] . "<br />";
            //echo "senha informada: " . $_POST["password"] . "<br />";
            $user = $this->_repoUser->getByLogin($login); 
            $loginEfetuado = false;           
            if ($user){
                if ($user->passwordIsValid($password)){
                    $_SESSION["userId"] = $user->getUserId(); 
                    $_SESSION["userName"] = stripslashes($user->getName());                     
                    header("Location: /admin/lista-usuarios");
                    $loginEfetuado = true;
                    exit; 
                }
            } 
            
            if ($loginEfetuado === false){
                $jsonError = new JsonError("Login ou senha inválidos.");
                header('Content-type:application/json;charset=utf-8');
                echo json_encode($jsonError);
            }
        }
    }
?>