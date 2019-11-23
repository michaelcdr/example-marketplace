<?php
    $titlePage = "Loja Whatever - Sua loja de instrumentos músicais e acessórios";
    require_once './views/partials/header.php';
    
?>   
<!-- conteudo principal -->
<main>
    <div class="container">
        <div class="row mt-3">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-dark">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Pesquisa</a></li>
                        <li class="breadcrumb-item active" aria-current="page"></li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row mt-1">
            <?php if(!isset($products) || count($products) === 0): ?>
            <div class="col-lg-12 col-md-12">
                <div class="">
                    Não encontramos resultados para <strong>
                    <?php echo $_GET["pesquisa"]; ?></strong>.

                    <h3>O que eu faço?</h3>
                    <ul>
                        <li>Verifique os termos digitados ou os filtros selecionados.</li>
                        <li>Utilize termos genéricos na busca.</li>
                    </ul>
                </div>
            </div>
            <?php else:  ?>
            <div class="col-lg-12 col-md-12">
                <section id="produtos-pesquisa-ct">
                <?php require_once './views/produto/card-list.php' ?>
                </section>
                
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">
                                <i class="fa fa-chevron-left"></i>
                            </a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">
                                <i class="fa fa-chevron-right"></i>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php require_once './views/partials/footer.php' ?>
<script src="js/controllers/PesquisaPageController.js"></script>
  