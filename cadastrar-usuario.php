<?php require_once './views/partials/header-admin.php' ?>

<div class="container">
    <div class="d-flex align-items-center p-3 mt-3 text-white-50 bg-dark rounded shadow-sm">
        <div class="lh-100">
            <h6 class="mb-0 text-white lh-100">Cadastro de usuário</h6>
            <small>Usuário > Cadastrar</small>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <form action="cadastrar-usuario-post.php" method="post" >
                <h5>Informe os dados do usuario e clique em salvar.</h6>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="nome">Nome:</label>
                            <input type="text" name="nome" id="nome"
                                class="form-control" placeholder="" aria-describedby="helpId">
                            <small id="helpId" class="text-muted">Nome do usuário</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="login">Login:</label>
                            <input type="text" name="login" id="login"
                                class="form-control" placeholder="" aria-describedby="helpId">
                            <small id="helpId" class="text-muted">Login do usuário</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="senha">Senha:</label>
                            <input type="password" name="senha" id="senha"
                                class="form-control" placeholder="" aria-describedby="helpId">
                            <small id="helpId" class="text-muted">Senha do usuário</small>
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <a class="btn btn-warning" href="listar-usuario.php">
                            <i class="fa fa-chevron-left"></i>
                        </a>
                        <button type="submit" name="btn-salvar" id="btn-salvar" 
                            class="btn btn-dark"><i class="fa fa-save"></i> Salvar usuário
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once './views/partials/footer-admin.php' ?>