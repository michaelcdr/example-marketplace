<?php
    use controllers\HomeController;
    use controllers\UserAdminController;
    use controllers\UserController;
    use controllers\SeedController;
    use services\SessionService;

    require_once 'autoload.php';
    require_once './infra/Facade.php';
    
    $uri =  $_SERVER["REQUEST_URI"];
    $sessionService = new SessionService();


    // if ($sessionService->isSessionStarted() === FALSE ) {
    //     echo "sessao nao startada";
    //     session_start();
        
    // } 
    
    switch($uri)
    {
        case "/":
            //echo "nome:" . $_SESSION["userName"] . ", id:". $_SESSION["userId"];
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

        case "/seed":
            $seed = new SeedController($factory);
            $seed->proccessRequest();
            break;

        case "/createdb": 
            $seed = new SeedController($factory);
            $seed->proccessCreateDbRequest();
            break;

        case "/destroydb":
            $seed = new SeedController($factory);
            $seed->proccessDestroyRequest();
            break;

        case "/logout":
            $userController = new UserController($factory);
            $userController->proccessLogoutRequest();
            break;

        case "/login":
            if ($sessionService->isAuthorized() === true)
                header("Location: /admin/lista-usuarios"); 
            else
            {
                echo $sessionService->isAuthorized();
                $userController = new UserController($factory);
                $userController->proccessLoginRequest();
            }
            break;

        case "/login-post":
            $userController = new UserController($factory);
            $userController->proccessLoginPostRequest();
            break;

        default:
            echo "nada encontrado para <strong>".$uri."</strong>";
            break;
    }  
?>