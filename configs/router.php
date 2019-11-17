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
    use controllers\RemoveFromCartController;
    use controllers\CartListController;
    use controllers\CartAtualizarQtdProdutoController;
    use controllers\ProductListController;
    use controllers\ProductCreateController;
    use controllers\ProductCreatePostController;
    use controllers\ProductEditController;
    use controllers\ProductEditPostController;
    use controllers\ProductPartialListController;
    use controllers\ProductDeleteController;
    use controllers\ProductImageUploadController;
    //rota X [controller , roles]

    $routes = [
        "/" => [HomeController::class, ""],
        "/createdb" => [CreateDbController::class, ""], 
        "/destroydb" => [DestroyDbController::class, ""],
        "/logout" => [UserLogoutController::class, "admin,vendedor"],
        "/login" => [UserLoginController::class, ""],
        "/autenticar" => [UserAuthenticateController::class, ""],
        "/pesquisa" => [SearchController::class, ""],
        "/seed" => [SeedController::class, ""],
        "/detalhes-produto" => [DetailsProductController::class, ""],
        "/carrinho"=> [CartController::class, ""],
        "/listar-itens-carrinho"=> [CartListController::class, ""],
        "/atualizar-quantidade-produto" => [CartAtualizarQtdProdutoController::class, ""],
        "/adicionar-carrinho" => [AddToCartController::class, ""],
        "/remover-item-carrinho" => [RemoveFromCartController::class, ""],       

        "/admin/usuario/editar" => [UserEditController::class,"admin"],
        "/admin/usuario/editar-post" => [UserEditPostController::class,"admin"],
        "/admin/usuario/cadastrar" => [UserCreateController::class,"admin"],
        "/admin/usuario/cadastrar-post" => [UserCreatePostController::class,"admin"],
        "/admin/usuario/deletar" => [UserDeleteController::class,"admin"],
        "/admin/usuario" => [UserListController::class,"admin"],        
        "/admin/usuario/lista-table" => [UserPartiaListController::class,"admin"],

        "/admin/produto" => [ProductListController::class, "admin,vendedor"],
        "/admin/produto/lista-partial" => [ProductPartialListController::class, "admin,vendedor"],
        "/admin/produto/cadastrar" => [ProductCreateController::class,"admin,vendedor"],
        "/admin/produto/cadastrar-post" => [ProductCreatePostController::class,"admin,vendedor"],
        "/admin/produto/editar" => [ProductEditController::class,"admin,vendedor"],
        "/admin/produto/editar-post" => [ProductEditPostController::class,"admin,vendedor"],
        "/admin/produto/deletar" => [ProductDeleteController::class,"admin,vendedor"],
        "/admin/produto/upload" => [ProductImageUploadController::class,"admin,vendedor"]
    ];

    return $routes;
    
?>