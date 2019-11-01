<?php
    use services\SessionService;

    require_once './configs/autoload.php';
    require_once './configs/Facade.php';
    //iniciando sessao
    $sessionService = new SessionService();
    $sessionService->start();

    $caminho =  "/";
    if (isset($_SERVER["PATH_INFO"]))
        $caminho =  $_SERVER["PATH_INFO"];
    $rotas = require __DIR__ . './configs/router.php';

    // echo '<pre>';
    // var_dump($_SERVER);
    // echo '</pre>';
    // echo $caminho;
    // exit();
    if (!array_key_exists($caminho, $rotas)){
        http_response_code(404);
        exit();
    }
    

    //fazendo um "de para" de rota e controller alvo
    $controllerAlvo = $rotas[$caminho];
    $controlador = new $controllerAlvo($factory);
    $controlador->proccessRequest();

?>