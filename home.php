<?php
    $titlePage = "Loja Whatever - Sua loja de instrumentos músicais e acessórios";
    require_once './views/partials/header.php';
?>   

<main>
    <!-- carrossel -->
    <?php require_once './views/carousel/lista.php' ?>

    <div class="container">
        <section id="ofertas-container">
            <h3 class="text-center">Ofertas em destaque</h3>
            <div class="row">
                <?php foreach ($ofertas as $oferta): ?>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="card card-oferta fade h-100">
                        <div class="p-3 text-center">
                            <img src="/img/products/<?php echo $oferta["Image"] ?>" 
                                class="card-img-top" alt="<?php echo $oferta["Image"] ?>" 
                                title="<?php echo $oferta["Image"] ?>">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title text-center">
                                <?php echo $oferta["Description"] ?>
                            </h5>
                            <p class="card-price h3 text-center">
                                R$ <?php echo $oferta["Price"] ?>
                            </p>
                            <a href="Product.php?id=<?php echo $oferta["ProductId"] ?>" 
                                class="btn btn-block btn-outline-dark"> Ver detalhes
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach?>
            </div>
        </section>

        <?php //require_once './views/category/lista.php' ?>
    </div>
</main>

<?php require_once './views/partials/footer.php' ?>
        

