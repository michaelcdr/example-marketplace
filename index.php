<?php
    namespace app;
    use controllers\HomeController;
    
    require_once 'autoload.php';
    require './infra/Facade.php';

    $uri =  $_SERVER["REQUEST_URI"];
    
    switch($uri){
        case "/":
            //echo "homeeeee<br/>";
            //var_dump($factory);
            $homeController = new HomeController($factory);
            $homeController->proccessRequest();
            
            break;

        case "/pesquisa":
            require "pesquisa.php";
            break;

        default:
            echo "nada encontrado para <strong>".$uri."</strong>";
            break;
    }  
?>