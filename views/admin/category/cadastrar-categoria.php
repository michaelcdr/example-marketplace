<?php require_once './views/partials/header-admin.php' ?>

<div class="container">
    <div class="d-flex align-items-center p-3 mt-3 text-white-50 bg-dark rounded shadow-sm">
        <div class="lh-100">
            <h6 class="mb-0 text-white lh-100">Cadastro de categoria</h6>
            <small>Categoria > Cadastrar</small>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <form action="cadastrar-categoria-post.php" method="post" >
                <h5>Informe os dados da categoria e clique em salvar.</h6>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="nome">Nome:</label>
                            <input type="text" name="nome" id="nome"
                                class="form-control" placeholder="" aria-describedby="helpId">
                            <small id="helpId" class="text-muted">Nome da categoria</small>
                        </div>
                    </div>
                                        
                    <div class="col-md-12">
                        <a class="btn btn-warning" href="lista-categoria.php">
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