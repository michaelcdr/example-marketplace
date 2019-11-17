<?php require_once './views/partials/header-admin.php' ?>

<div class="container">
    <div class="d-flex align-items-center p-3 mt-3 text-white-50 bg-dark rounded shadow-sm">
        <div class="lh-100">
            <h6 class="mb-0 text-white lh-100">Edição de usuário</h6>
            <ul class="nav-breadcrumb">
                <li>
                    <a href="/admin/usuario">Lista de usuários</a>
                </li>
                <li>
                    <a href="/admin/usuario/editar?id=<?php echo $user->getUserId(); ?>">Editar usuário</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <form action="/admin/usuario/cadastrar-post" method="post" id="formUsuario" >
                <h5>Informe os dados do usuario e clique em salvar.</h6>
                <div class="row">
                    
                    <input type="hidden" name="userId" id="userId" value="<?php echo $user->getUserId(); ?>">
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">Nome:</label>
                            <input type="text" name="name" id="name"
                                data-required="true" value="<?php echo $user->getName(); ?>"
                                class="form-control" placeholder="" aria-describedby="helpId">
                            <small id="help-name" class="text-muted">Nome do usuário</small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="login">Login:</label>
                            <input type="text" name="login" id="login"
                                data-required="true" value="<?php echo $user->getLogin(); ?>"
                                class="form-control" placeholder="" aria-describedby="helpId">
                            <small id="help-login" class="text-muted">Login do usuário</small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="role">Tipo:</label>
                            <select name="role" id="role" 
                                data-required="true" 
                                class="form-control" 
                                aria-describedby="help-role" 
                            >
                                <option value="">Selecione o tipo...</option>
                                <option value="comum" <?php echo $user->getRole()  == "comum" ? "selected=selected":""; ?>>
                                    Comum
                                    </option>
                                <option value="vendedor" <?php echo $user->getRole() == "vendedor" ? "selected=selected":""; ?>>
                                    Vendedor
                                </option>
                                <option value="admin" <?php echo $user->getRole() == "admin" ? "selected=selected":""; ?>>
                                    Administrador
                                </option>
                            </select>
                            <small id="help-role" class="text-muted">Tipo de usuário</small>
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <a class="btn btn-warning btn-sm " href="/admin/usuario">
                            <i class="fa fa-chevron-left"></i>
                        </a>
                        <button type="submit" name="btn-salvar" id="btn-salvar" 
                            class="btn btn-dark btn-sm "><i class="fa fa-save"></i> Salvar usuário
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once './views/partials/scripts-admin.php' ?>
<script src="/js/models/UserForm.js"></script>
<?php require_once './views/partials/footer-admin.php' ?>