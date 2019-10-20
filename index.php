<?php
    namespace app;
    use controllers\HomeController;
    use controllers\UserAdminController;
use controllers\UserController;



require_once 'autoload.php';
    require_once './infra/Facade.php';

    $uri =  $_SERVER["REQUEST_URI"];
    
    switch($uri){
        case "/":
            $homeController = new HomeController($factory);
            $homeController->proccessRequest();
            break;
        
        case "/admin/cadastrar-usuario-post":
            $userController = new UserAdminController($factory);
            $userController->proccessCreatePostRequest();
            break;

        case "/admin/cadastrar-usuario":  
            $userController = new UserAdminController($factory);
            $userController->proccessCreateRequest(null);      
            
            break;

        case "/admin/lista-usuarios":
            $userController = new UserAdminController($factory);
            $userController->proccessRequest();
            break;

        case "/pesquisa":
            require "pesquisa.php";
            break;

        case "/login":
            $userController = new UserController($factory);
            $userController->proccessLoginRequest();
            break;

        default:
            echo "nada encontrado para <strong>".$uri."</strong>";
            break;
    }  
?>