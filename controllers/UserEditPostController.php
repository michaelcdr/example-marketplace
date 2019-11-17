<?php
    namespace controllers;
    
    use controllers;
    use infra;
    use models;
    use infra\repositories;
    use models\JsonSuccess;
    use models\JsonError;
    use models\UserEdit;

    class UserEditPostController implements IBaseController
    {
        private $_repoUser;

        public function __construct($factory)
        {
            $this->_repoUser = $factory->getUserRepository();
        }
        
        public function proccessRequest() : void
        {
            $userId = $_POST["userId"];
            $name = $_POST["name"];
            $login = $_POST["login"];
            $role = $_POST["role"];

            $user = new UserEdit($userId, $name, $login, $role);
            if ($user->isValid())
            {
                $this->_repoUser->altera($user);                
                $retorno = new JsonSuccess("Usuário alterado com sucesso");
                header('Content-type:application/json;charset=utf-8');
            } 
            else 
                $retorno = new JsonError("Não foi possivel cadastrar o usuário");                
                
            echo json_encode($retorno);
        }
    }
?>