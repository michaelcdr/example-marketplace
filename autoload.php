<?php
    //echo 'Cheguei no autoload.<br />';
    function load($namespace)
    {
       
        $namespace = str_replace("\\" , "/", $namespace);
        //echo "namespace: " . $namespace . "<br />";
        //echo "diretorio base : " . __DIR__ . "<br />" ;
        
        
        $caminhoAbsoluto = __DIR__ . "/" . $namespace . ".php";
        return include_once $caminhoAbsoluto;
        
    }
    spl_autoload_register(__NAMESPACE__ . "\load");
?>