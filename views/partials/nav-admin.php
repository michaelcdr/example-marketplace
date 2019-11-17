<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" title="Voltar para o site." href="/">
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
                        <a class="nav-link" href="/admin/categorias">
                            Categorias <span class="sr-only"></span>
                        </a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="/admin/vendedores">
                            Vendedores <span class="sr-only"></span>
                        </a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="/admin/produto">
                            Produtos <span class="sr-only"></span>
                        </a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="/admin/usuario">
                            Usuários <span class="sr-only"></span>
                        </a>
                    </li>
                    
                </ul>
                <div class="form-inline">
                    <span class="login-nav text-light ml-3">
                        <?php if (isset($_SESSION["userId"])) :?>
                            <i class="fa fa-user"></i> Olá, 
                            <a href="/admin/detalhes/<?php echo $_SESSION["userId"]?>" class="a-primary" >
                                <?php echo $_SESSION["userName"] ?>
                            </a> clique em 
                            <a href="/logout" class="a-primary" title="Sair no sistema" 
                                data-container="body"
                                data-toggle="tooltip" data-placement="body">Sair
                            </a> 
                            <br /> para fazer seu logout.
                        <?php endif;?>
                    </span>
                </div>
            </div>
        </div>
    </nav>
</header>