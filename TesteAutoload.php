<?php
    
    ini_set("display_errors",1);
    require_once 'autoload.php';
    echo 'Teste autoload ...<br />';
    use models\UsuarioMaster;
    $userMaster = new UsuarioMaster();