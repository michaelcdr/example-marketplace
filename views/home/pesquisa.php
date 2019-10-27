<!doctype html>
<html lang="en">
    <head>
        <title>Loja Whatever - Sua loja de instrumentos músicais e acessórios</title>
        <?php require_once './views/partials/header.php' ?>
    </head>
    <body>  
        <!-- cabeçalho e navegação -->
        <?php require_once './views/partials/nav.php' ?>
        

        <!-- conteudo principal -->
        <main>
            <div class="container">
                <div class="row mt-3">
                    <div class="col-md-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb bg-dark">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item"><a href="#">Pesquisa</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Guitarra Esp Ltd</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 ">
                        <div class="card pt-3 w-100 h-100 d-inline-block">
                            <div class="col-md-12">
                                <h5>
                                    Guitarra Esp Ltd<br />
                                    <small><strong>4</strong> resultados encontrados.</small>
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-8">
                        <section id="produtos-pesquisa-ct">
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 mb-3">
                                    <div class="card card-oferta fade h-100">
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
                                            <a href="detalhes-produto.html" class="btn btn-block btn-outline-dark">Comprar</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 mb-3">
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
                                            <a href="detalhes-produto.html" class="btn btn-block btn-outline-dark">Comprar</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 mb-3">
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
                                            <a href="detalhes-produto.html" class="btn btn-block btn-outline-dark">Comprar</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 mb-3">
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
                                            <a href="detalhes-produto.html" class="btn btn-block btn-outline-dark">Comprar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                            
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
        </main>

        <?php require_once '/views/partials/footer.php' ?>
        <script src="js/controllers/PesquisaPageController.js"></script>
    </body>
</html>