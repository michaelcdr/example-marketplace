<?php
    function load($namespace)
    {
        $namespace = str_replace("\\" , "/", $namespace);
        
        //voltando um diretorio pois o autoload esta em /infra...
        $caminhoAbsoluto = __DIR__ . "../../" . $namespace . ".php";
        return include_once $caminhoAbsoluto;
    }
    spl_autoload_register(__NAMESPACE__ . "\load");
?>