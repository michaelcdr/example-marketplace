<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/">
            <span class="logo-strong">L</span>oja<span class="logo-strong">W</span>hatever
        </a>
        <button class="navbar-toggler" type="button" 
                data-toggle="collapse" data-target="#navbarSupportedContent" 
                aria-controls="navbarSupportedContent" aria-expanded="false" 
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/">
                        Home <span class="sr-only">(current)</span>
                    </a>
                </li>
            </ul>
            <form class="form-inline" id="form-pesquisa" action="pesquisa.php" method="GET">
                <div class="input-group mr-3">
                    <input type="text" class="form-control" id="pesquisa" 
                        placeholder="Pesquisar produto" 
                        aria-label="Pesquisar produto" aria-describedby="button-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-outline-light" type="button" id="button-addon2">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
                <a href="carrinho.html" class="btn btn-outline-light my-2 my-sm-0" 
                    title="Acessar seu carrinho" 
                    data-toggle="tooltip" data-placement="body"  
                    data-container="body" >
                    <i class="fa fa-cart-plus"></i>  
                    <span class="badge badge-light">1</span>
                </a>
                
                <span class="login-nav text-light ml-3">
                    <?php  if(isset($_SESSION["userId"])): ?>
                        <i class="fa fa-user"></i> Olá, 
                        <a href="/admin/detalhes/<?php echo $_SESSION["userId"]?>" class="a-primary" >
                            <?php echo $_SESSION["userName"] ?>
                        </a> clique em 
                        <a href="/logout" class="a-primary" title="Sair no sistema" 
                            data-container="body"
                            data-toggle="tooltip" data-placement="body">Sair
                        </a> 
                        <br /> para fazer seu logout.
                    <?php  else: ?>

                        <i class="fa fa-user"></i> Olá , Faça seu 
                        <a href="/login" class="a-primary" 
                            data-container="body" title="Entrar no sistema" 
                            data-toggle="tooltip" data-placement="body">Login</a> 
                        <br /> ou 
                        <a href="cadastro-usuario.html" class="a-primary" 
                            title="Entrar no sistema" 
                            data-container="body">Cadastre-se
                        </a>.
                    <?php  endif; ?>
                </span>
            </form>
        </div>
    </div>
</nav>