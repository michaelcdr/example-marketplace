<?php
    namespace controllers;
    use infra;
    use infra\repositories;
    use models\User;
    use services\validators\UserValidator;

    class UserAdminController implements IBaseController
    {
        private $_repoUser;

        public function __construct($factory)
        {
            $this->_repoUser = $factory->getUserRepository();
        }
        
        public function proccessRequest() : void
        {
            $users = $this->_repoUser->getAll(0,0,0);
            require "views/admin/lista-usuario.php";
        }

        public function proccessCreateRequest() : void
        {
            // echo "mostrando dados do post<br />";
            // echo "login: " . $_POST["login"] . "<br />";
            // echo "senha: " . $_POST["senha"] . "<br />";
            // echo "nome: " . $_POST["nome"]. "<br />";

            //removendo possiveis tags e scripts...
            $login = filter_input(INPUT_POST,'login',FILTER_SANITIZE_STRING);
            $password = filter_input(INPUT_POST,'password',FILTER_SANITIZE_STRING);
            $name = filter_input(INPUT_POST,'name',FILTER_SANITIZE_STRING);
            $user = new User($login,$password,$name);

            $userValidator = new UserValidator($user);

            if ($userValidator->isValid()){
                $this->_repoUser->add();
                header('Location: lista-usuarios');
            } else {
                echo '<pre>';
                var_dump($userValidator);
                echo '</pre>';
            }
        }
    }
?>