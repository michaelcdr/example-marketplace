<?php
    use services\SessionService;
    use services\AuthService;

    require_once './configs/autoload.php';
    require_once './configs/facade.php';

    //iniciando sessao
    $sessionService = new SessionService();
    $sessionService->start();

    $caminho =  "/";
    if (isset($_SERVER["PATH_INFO"]))
        $caminho =  $_SERVER["PATH_INFO"];
        
    $rotas = require __DIR__ . './configs/router.php';

    if (!array_key_exists($caminho, $rotas))
    {
        http_response_code(404);
        exit();
    }

    // $authService = new AuthService($caminho);
    // if (!$authService->isAuthorized()){
    //     header('Location:' . $authService->routeWarning);
    // }
    // echo "Autenticação: ";
    // echo "UserId: " . $_SESSION["userId"] . ", username: " . $_SESSION["userName"];
    // echo ", Role: " . $_SESSION["role"];
    // echo ", PathInfo: " . $caminho;

    //fazendo um "de para" de rota para o Controller alvo...
    $controllerAlvo = $rotas[$caminho][0];
    $controlador = new $controllerAlvo($factory);
    $controlador->proccessRequest();

?>