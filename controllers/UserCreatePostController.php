<?php
    namespace controllers;
    use infra;
    use models;
    use infra\repositories;
    use models\JsonSuccess;
    use models\JsonError;
    use models\User;

    class UserCreatePostController implements IBaseController
    {
        private $_repoUser;

        public function __construct($factory)
        {
            $this->_repoUser = $factory->getUserRepository();
        }
        
        public function proccessRequest() : void
        {
            // echo "mostrando dados do post<br />";
            // echo "login: " . $_POST["login"] . "<br />";
            // echo "senha: " . $_POST["senha"] . "<br />";
            // echo "nome: " . $_POST["nome"]. "<br />";
            
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