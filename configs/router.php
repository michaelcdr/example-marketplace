<?php
    use controllers\HomeController;
    use controllers\CreateDbController;
    use controllers\DestroyDbController;
    use controllers\UserLogoutController;
    use controllers\UserLoginController;
    use controllers\UserAuthenticateController;
    use controllers\SearchController;
    use controllers\SeedController;
    use controllers\DetailsProductController;
    
    use controllers\UserCreateController;
    use controllers\UserEditController;
    use controllers\UserEditPostController;
    use controllers\UserCreatePostController;
    use controllers\UserDeleteController;
    use controllers\UserListController;
    use controllers\UserPartiaListController;
    use controllers\AddToCartController;
    use controllers\CartController;

    $routes = [
        "/" => HomeController::class,
        "/createdb" => CreateDbController::class, 
        "/destroydb" => DestroyDbController::class,
        "/logout" => UserLogoutController::class,
        "/login" => UserLoginController::class,
        "/autenticar" => UserAuthenticateController::class,
        "/pesquisa" => SearchController::class,
        "/seed" => SeedController::class,
        "/detalhes-produto" => DetailsProductController::class,
        "/carrinho"=>CartController::class,
        "/adicionar-carrinho" => AddToCartController::class,
        "/admin/editar-usuario" => UserEditController::class,
        "/admin/editar-usuario-post" => UserEditPostController::class,

        "/admin/cadastrar-usuario" => UserCreateController::class,
        "/admin/cadastrar-usuario-post" => UserCreatePostController::class,
        "/admin/deletar-usuario" => UserDeleteController::class,
        "/admin/lista-usuarios" => UserListController::class,
        "/admin/lista-usuarios-table" => UserPartiaListController::class

    ];

    return $routes;
    
?>