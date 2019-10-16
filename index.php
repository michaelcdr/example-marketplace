<?php
    namespace app;
    use controllers\HomeController;
    use controllers\UserAdminController;
    
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
            $userController->proccessCreateRequest();
            break;

        case "/admin/cadastrar-usuario":        
            require "views/admin/cadastrar-usuario.php";
            break;

        case "/admin/lista-usuarios":
            $userController = new UserAdminController($factory);
            $userController->proccessRequest();
            break;

        case "/pesquisa":
            require "pesquisa.php";
            break;

        default:
            echo "nada encontrado para <strong>".$uri."</strong>";
            break;
    }  
?>