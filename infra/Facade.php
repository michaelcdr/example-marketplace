<?php
     //echo 'entrou no facade <br />';

     
    // include_once('dao/UsuarioDao.php');
    // include_once('dao/DaoFactory.php');
    
    require_once './models/User.php';
    require_once './infra/RepositoryFactory.php';
    require_once './infra/MySqlRepositoryFactory.php';
    $factory = new MySqlRepositoryFactory();
?>