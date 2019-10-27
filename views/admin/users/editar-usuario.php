<?php require_once './views/partials/header-admin.php' ?>

<div class="container">
    <div class="d-flex align-items-center p-3 mt-3 text-white-50 bg-dark rounded shadow-sm">
        <div class="lh-100">
            <h6 class="mb-0 text-white lh-100">Edição de usuário</h6>
            <small>Usuário > Editar</small>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <form action="/admin/cadastrar-usuario-post" method="post" id="formUsuario" >
                <h5>Informe os dados do usuario e clique em salvar.</h6>
                <div class="row">
                    
                    <input type="hidden" name="userId" id="userId" value="<?php echo $user->getUserId(); ?>">
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Nome:</label>
                            <input type="text" name="name" id="name"
                                data-required="true" value="<?php echo $user->getName(); ?>"
                                class="form-control" placeholder="" aria-describedby="helpId">
                            <small id="help-name" class="text-muted">Nome do usuário</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="login">Login:</label>
                            <input type="text" name="login" id="login"
                                data-required="true" value="<?php echo $user->getLogin(); ?>"
                                class="form-control" placeholder="" aria-describedby="helpId">
                            <small id="help-login" class="text-muted">Login do usuário</small>
                        </div>
                    </div>
        
                    
                    <div class="col-md-12">
                        <a class="btn btn-warning" href="lista-usuarios">
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

<?php require_once './views/partials/scripts-admin.php' ?>
<script src="/js/models/CadastroUsuario.js"></script>
<?php require_once './views/partials/footer-admin.php' ?>