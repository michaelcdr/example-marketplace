<?php
    namespace controllers;
    use infra;
    use infra\repositories;

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
        
        public function proccessLoginPostRequest() 
        {
            session_start();
            // echo "mostrando dados do post<br />";
            // echo "login: " . $_POST["login"] . "<br />";
            // echo "senha: " . $_POST["password"] . "<br />";
            $login = filter_input(INPUT_POST,'login',FILTER_SANITIZE_STRING);
            $password = filter_input(INPUT_POST,'password',FILTER_SANITIZE_STRING);
            
            //dibulhando metódos do php para sacar o que fazem...
            
            //MD5
            //echo 'senha md5: ' . md5(trim($_POST["password"])) . '<br />';            

            //echo 'login com slashes: ' . addslashes(trim($_POST["login"])) . '<br />';
            //echo 'php_sapi_name(): ' . php_sapi_name() . '<br />';
            //echo 'version_compare(): ' . version_compare(phpversion(), '5.4.0', '>=') . '<br />';
            //echo 'session_status(): ' . session_status(). '<br />';
            

            //ARGON2I..
            echo 'hasargon2i:' . password_hash(trim($_POST["password"]), PASSWORD_ARGON2I). '<br />';
            if (password_verify("senhateste",password_hash(trim($_POST["password"]), PASSWORD_ARGON2I))){
                echo 'senha ok';
                 


            } else{
                echo 'senha nom ok';
            }

            //exemplos

            // $email = filter_input(INPUT_POST,
            //     'email',
            //     FILTER_VALIDATE_EMAIL
            // );
        
            // if (is_null($email) || $email === false) {
            //     echo "O e-mail digitado não é um e-mail válido";
            //     exit();
            // }
        
            // $senha = filter_input(INPUT_POST,
            //     'senha',
            //     FILTER_SANITIZE_STRING);
        
            // /** @var  $usuario */
            // $usuario = $this->repositorioUsuarios
            //     ->findOneBy(['email' => $email]);
        
            // if (is_null($usuario) || !$usuario->senhaEstaCorreta($senha)) {
            //     echo "E-mail ou senha inválidos";
            //     return;
            // }
        
            // header('Location: /listar-cursos');


            //exemplos2
            // $dao = $factory->getUsuarioDao();
            // $usuario = $dao->buscaPorLogin($login);

            // $problemas = FALSE;
            // if($usuario) {
            // // Agora verifica a senha 
            // if(!strcmp($senha, $usuario->getSenha())) 
            // { 
            // // TUDO OK! Agora, passa os dados para a sessão e redireciona o usuário 
            // $_SESSION["id_usuario"]= $usuario->getId(); 
            // $_SESSION["nome_usuario"] = stripslashes($usuario->getNome()); 
            // //$_SESSION["permissao"]= $dados["postar"]; 
            // header("Location: index.php"); 
            // exit; 
            // } else {
            // $problemas = TRUE; 
            // }
            // } else {
            // $problemas = TRUE; 
            // }

            // if($problemas==TRUE) {
            // header("Location: index.php"); 
            // exit; 
            // }

        }
    }
?>