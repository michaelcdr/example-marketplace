<?php 
     require_once './views/partials/header-admin.php';
?>

<div class="container">
    <div class="d-flex align-items-center p-3 mt-3 text-white-50 bg-dark rounded shadow-sm">
        <div class="lh-100">
            <h6 class="mb-0 text-white lh-100">Lista de usuários</h6>
            <small>Categorias > Lista de usuários</small>
        </div>
    </div>

    <div class="card mt-3 ">
        <div class="card-body">
            <h5>Veja abaixo os usuários disponiveis.</h6>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Pesquise pelo titulo da categoria" 
                                aria-label="Pesquise pelo titulo da categoria" aria-describedby="btn-pesquisar">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" id="btn-pesquisar">
                                    Pesquisar
                                </button>
                            </div>
                        </div>
                    </div>
                    <p>
                        <a class="btn btn-dark btn-sm" href="/admin/cadastrar-usuario">
                            <i class="fa fa-plus"></i> Cadastrar usuário
                        </a>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-hovered table-striped">
                        <thead>
                            <tr>
                                <th width="10%"></th>
                                <th>Login</th>
                                <th>Nome</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php  if (count($users) == 0) : ?>
                                <tr>
                                    <td colspan="3">Nenhum registro cadastrado.</td>
                                </tr>
                            <?php else  :?>
                                <?php foreach ($users as $user): ?>
                                    <tr>
                                        <td>
                                            <div class="btn-group">
                                                <button class='btn btn-sm btn-outline-danger' 
                                                    data-id="<?php echo $user["UserId"] ?>">
                                                    <i class="fa fa-remove"></i>
                                                </button>
                                                <a class='btn btn-sm btn-outline-dark' 
                                                    href="/admin/editar-usuario/<?php echo $user["UserId"] ?>">
                                                    <i class="fa fa-edit" ></i>
                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                            <?php echo $user["Login"] ?>
                                        </td>
                                        <td>
                                            <?php echo $user["Name"] ?>
                                        </td>
                                    </tr>
                                <?php endforeach?>
                            <?php endif ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <p>
                        <a class="btn btn-dark btn-sm" href="/cadastrar-usuario">
                            <i class="fa fa-plus"></i> Cadastrar usuário
                        </a>
                    </p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-end">
                            <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">Anterior</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Próxima</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            
        </div>
    </div>
</div>

<?php require_once './views/partials/scripts-admin.php' ?>
<?php require_once './views/partials/footer-admin.php' ?>