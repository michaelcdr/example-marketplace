<?php
    namespace controllers;
    use infra;
    use models;
    use infra\repositories;
    use models\JsonSuccess;
    use models\JsonError;
    use models\User;

    class UserAdminController implements IBaseController
    {
        private $_repoUser;

        public function __construct($factory)
        {
            $this->_repoUser = $factory->getUserRepository();
        }
        
        public function proccessRequest() : void
        {
            $users = $this->_repoUser->getAll(1, null);
            require "views/admin/lista-usuario.php";
        }
        
        public function proccessListRequest():void
        {
            // $page = $_GET["page"];
            // $pesquisa = $_GET["pesquisa"];
            $users = $this->_repoUser->getAll(0, null);
            require "views/admin/lista-usuarios-table.php";
        }

        public function proccessCreateRequest() : void
        {
            require "views/admin/cadastrar-usuario.php";
        }
        
        public function proccessDeleteRequest()
        {
            try
            {
                $this->_repoUser->remove($_POST["id"]);
                $retorno = new JsonSuccess("Usuário removido com sucesso.");
                header('Content-type:application/json;charset=utf-8');
                echo json_encode($retorno);
            }  
            catch (Exception $e) 
            {
                $retorno = new JsonError("Não foi possivel cadastrar o usuário");   
                header('Content-type:application/json;charset=utf-8');
                echo json_encode($retorno);
            }
        }

        public function proccessCreatePostRequest() 
        {
            //removendo possiveis tags e scripts...
            $login = filter_input(INPUT_POST,'login',FILTER_SANITIZE_STRING);
            $password = filter_input(INPUT_POST,'password',FILTER_SANITIZE_STRING);
            $name = filter_input(INPUT_POST,'name',FILTER_SANITIZE_STRING);
            // echo $password . '<br>';
            // echo password_hash($password, PASSWORD_ARGON2I) . '<br>';
            // echo password_verify('giacom',password_hash($password, PASSWORD_ARGON2I));
            $user = new User(null,$login,trim($password),$name);
            
            //validando modelo se valido retornamos um JSON.
            if ($user->isValid())
            {
                $this->_repoUser->add($user);
                //header('Location: lista-usuarios');
                $retorno = new JsonSuccess("Usuário cadastrado com sucesso");
                header('Content-type:application/json;charset=utf-8');
            } 
            else 
                $retorno = new JsonError("Não foi possivel cadastrar o usuário");                
                
            echo json_encode($retorno);
        }
    }
?>