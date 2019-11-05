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
                                    <input type="text" class="form-control" placeholder="Pesquise pelo titulo do produto" 
                                        aria-label="Pesquise pelo titulo do produto" aria-describedby="btn-pesquisar">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" id="btn-pesquisar">
                                            Pesquisar
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <p>
                                <a class="btn btn-dark " href="cadastro-produto.html">
                                    <i class="fa fa-plus"></i> Cadastrar produto
                                </a>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 ">
                            <div class="card card-oferta mb-3 fade h-100">
                                <div class="p-3">
                                    <img src="/img/produto1.jpg" class="card-img-top" alt="...">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title text-center">
                                        Notebook Predator Helios 300 G3-572-75L9 Intel Core i7 16GB 
                                        (Geforce GTX 1060 com 6GB) 2TB Tela IPS Full HD 15,6'' W10 - Acer
                                    </h5>
                                    <p class="card-price h3 text-center">
                                        R$ 5.034,99
                                    </p>

                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-danger" title="Remover produto" 
                                            data-toggle="tooltip" data-container="body">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        <a href="editar-produto.html"
                                            class="btn btn-sm btn-outline-secondary">
                                            <i class="fa fa-edit"></i> Editar
                                        </a>
                                        <!-- <a href="#" class="btn btn-sm btn-outline-secondary">
                                            <i class="fa fa-trash"></i> Ver detalhes
                                        </a> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="card card-oferta fade h-100">
                                <div class="p-3">
                                    <img src="/img/produto2.jpg" class="card-img-top" alt="...">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title text-center">
                                        Guitarra Esp Ltd Ec-256 Preta Fosca Lespaul Mogno Custom Black
                                    </h5>
                                    <p class="card-price h3 text-center">
                                        R$ 2.982,76
                                    </p>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-danger" title="Remover produto" 
                                            data-toggle="tooltip" data-container="body">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        <a href="editar-produto.html" class="btn btn-sm btn-outline-secondary">
                                            <i class="fa fa-edit"></i> Editar
                                        </a>
                                        <!-- <a href="detalhar-produto.html" class="btn btn-sm btn-outline-secondary">
                                            <i class="fa fa-trash"></i> Ver detalhes
                                        </a> -->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12">
                            
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
                        <a class="btn btn-dark " href="cadastro-produto.html">
                            <i class="fa fa-plus"></i> Cadastrar produto
                        </a>
                    </p>
                </div>
               
            </div>
        </div>
        <script src="js/lista-produto.js"></script>
<?php require_once './views/partials/footer-admin.php' ?>

    