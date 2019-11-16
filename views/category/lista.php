 
<section id="linhas" class="fade ">
    <h3 class="text-center mt-2">Navegue pelas nossas linhas de produtos</h3>
    <div class="row">
        <div class="col-lg-12">
            <ul class="linhas-list">
                <?php foreach ($categories as $category): ?>
                <li>
                    <div class="card-linha">
                        <img src="img/categories/<?php echo $category["Image"] ?>" 
                            alt="<?php echo $category["Title"] ?>" class="">
                    </div>
                    <div class="card-linha-title "><?php echo $category["Title"] ?></div> 
                </li>
                <?php endforeach?>
            </ul>
        </div>
    </div>
</section>