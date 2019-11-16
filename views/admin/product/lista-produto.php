<?php 
     require_once './views/partials/header-admin.php';
?>
<div class="container">
    <div class="d-flex align-items-center p-3 mt-3 text-white-50 bg-dark rounded shadow-sm">
        <div class="lh-100">
            <h6 class="mb-0 text-white lh-100">Lista de produto</h6>
            <small>Produto > Lista de produtos</small>
        </div>
    </div>

    <div class="card mt-3 ">
        <div class="card-body">
            <h5>Veja abaixo os produtos disponiveis.</h6>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="search-products" placeholder="Pesquise pelo titulo do produto" 
                                aria-label="Pesquise pelo titulo do produto" aria-describedby="btn-pesquisar">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" id="btn-pesquisar">
                                    Pesquisar
                                </button>
                            </div>
                        </div>
                    </div>
                    <p>
                        <a class="btn btn-dark " href="/admin/produtos/cadastrar">
                            <i class="fa fa-plus"></i> Cadastrar produto
                        </a>
                    </p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12" id="container-products">
                    <?php include './views/admin/product/lista-produtos-table.php' ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-3">
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
            <p class="mt-3">
                <a class="btn btn-dark " href="/admin/produtos/cadastrar">
                    <i class="fa fa-plus"></i> Cadastrar produto
                </a>
            </p>
        </div>
    </div>
</div>
<?php require_once './views/partials/scripts-admin.php' ?>
<script src="../js/models/ListaProduto.js"></script>
<?php require_once './views/partials/footer-admin.php' ?>

    