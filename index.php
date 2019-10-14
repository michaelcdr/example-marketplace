<?php
    $uri =  $_SERVER["REQUEST_URI"];


    switch($uri){
        case "/":
            require "home.php";
            break;

        case "/pesquisa":
            require "pesquisa.php";
            break;

        default:
            echo "nada encontrado para <strong>".$uri."</strong>";
            break;
    }  
?>