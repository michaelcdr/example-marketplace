<?php
    $titlePage = "Loja Whatever - Sua loja de instrumentos músicais e acessórios";
    require_once './views/partials/header.php';
?>   

<!-- conteudo principal -->
<main>
    <div class="container">
        <section id="caminho-carrinho">
            <div class="row mt-3" >
                <div class="col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-dark">
                            <li class="breadcrumb-item active" aria-current="page">Carrinho</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </section>

        <section id="meu-carrinho">
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <div class="card p-3">
                        <div class="row">
                            <?php if($cartViewModel != null):?>
                                <div class="col-lg-8">
                                    <h4>Meu Carrinho</h4>
                                    
                                    <table class="table table-condensed cols-centered">
                                        <thead>
                                            <tr>
                                                <th width="10px"></th>
                                                <th>Img</th>
                                                <th>Produto</th>
                                                <th width="100px">Qtd.</th>
                                                <th width="100px">Preço</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                foreach($cartViewModel->getProducts() as $productArray ) 
                                                {
                                            ?>
                                                <tr>
                                                    <td>
                                                        <button class="btn-danger btn btn-sm">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </td>
                                                    <td class="center">
                                                        <img src="<?php echo $productArray->getImage(); ?>" 
                                                            width="70px" 
                                                            alt="<?php echo $productArray->getImage(); ?>" />
                                                    </td>
                                                    <td class="center">
                                                        <?php echo $productArray->getTitle(); ?>
                                                    </td>
                                                    <td>
                                                        <input type="number" 
                                                            value="<?php echo $productArray->getQtd(); ?>" 
                                                            class="form-control">
                                                    </td>
                                                    <td class="text-center">
                                                        R$ <?php echo  $productArray->getSubTotal(); ?>
                                                    </td>
                                                </tr>
                                            <?php

                                                }
                                            ?>   
                                                
                                        </tbody>
                                    </table>
                                
                                </div>

                                <div class="col-lg-4">
                                    <div class="card h-100 bg-light p-2">
                                        <h4>Resumo do pedido</h4>
                                        <div class="row">
                                            <div class="col-lg-8">
                                                Subtotal (1 produtos)
                                            </div>
                                            <div class="col-lg-4 text-right">
                                                R$ 3.835,92
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                Frete
                                            </div>
                                            <div class="col-lg-6 text-right">
                                                R$ 100,00
                                            </div>
                                        </div>
                                        <hr/>    
                                        <div class="row">
                                            <div class="col-lg-6">
                                                Total
                                            </div>
                                            <div class="col-lg-6 text-right">
                                                R$ 3.935,92
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">Em até 1x s/ juros</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <a class="btn btn-block btn-success" href="carrinho-checkout.html">
                                                    <i class="fa fa-check"></i> Finalizar pedido
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            <?php else : ?>  
                                <div class="col-lg-12">
                                    <h4>Meu Carrinho</h4>      
                                    <div class="alert alert-info" role="alert">
                                    Não há produtos no carrinho.
                                    </div>
                                </div>
                            <?php endif ;?>  
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>
        
<?php require_once './views/partials/footer.php' ?>