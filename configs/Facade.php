<?php
    namespace infra;
    $basePath = __DIR__;

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    $factory = new MySqlRepositoryFactory();
?>