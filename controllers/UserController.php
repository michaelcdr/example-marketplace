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
            if (!isset($_SESSION["userId"]))
            {
                echo 'deslogado';
            } 
            else
            {
                echo 'logado';
            }
            require "views/usuario/login.php";
        }

        public function proccessRequest() : void
        {
            
        }
        
        // public function proccessLogoutRequest() 
        // {
        //     if (isset($_SESSION["userId"])) {
        //         session_destroy();
        //         header("location: /");
        //         exit;
        //     } 
        // }

        public function proccessLoginPostRequest() 
        {
            $login = filter_input(INPUT_POST,'login',FILTER_SANITIZE_STRING);
            $password = filter_input(INPUT_POST,'password',FILTER_SANITIZE_STRING);
            $user = $this->_repoUser->getByLogin($login); 
            $loginEfetuado = false;
            if (!is_null($user)){
                //echo 'usuario encontrado<br>';
                if ($user->passwordIsValid($_POST["password"])){
                    //echo 'senha valida<br>';
                    $_SESSION["userId"] = $user->getUserId(); 
                    $_SESSION["userName"] = stripslashes($user->getName());                     
                    $jsonReturn = new JsonSuccess("Login realizado com sucesso.");
                    $loginEfetuado = true;
                    header('Content-type:application/json;charset=utf-8');
                    echo json_encode($jsonReturn);
                } 
            } 
            if (!$loginEfetuado){
                $jsonReturn = new JsonError("Login ou senha inválidos.");
                header('Content-type:application/json;charset=utf-8');
                echo json_encode($jsonReturn);
            }
        }
    }
?>