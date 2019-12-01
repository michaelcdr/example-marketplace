<?php
    $titlePage = "Loja Whatever - Sua loja de instrumentos músicais e acessórios";
    require_once './views/partials/header.php';
?>   

<!-- conteudo principal -->
<main>
    <div class="container">
        <!-- breadcrumb -->
        <section id="caminho-carrinho">
            <div class="row mt-3">
                <div class="col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-dark text-white">
                            <li class="breadcrumb-item " aria-current="page">Meu carrinho</li>
                            <li class="breadcrumb-item " aria-current="page">Identificação</li>
                            <li class="breadcrumb-item active" aria-current="page">Pagamento</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </section>

        <section id="meu-carrinho">
            <form action="cart-checkout-post" method="post" id="form-cadastro">
                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                        <div class="card p-3">
                            <div class="row">
                                <div class="col-lg-8">
                                    <h5>Pagamento: </h5>
                                </div>
                                <div class="col-lg-4">
                                    <h5>Resumo da compra: </h5>  
                                </div>  
                            </div>

                            <div class="row">
                                <div class="col-md-8">
                                    <div class="category-fieldset">
                                        <span class="title">Dados de pagamento:</span>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="card-number">N. Cartão</label>
                                                            <input id="card-number" data-required="true" 
                                                             maxlength="16" class="form-control" type="text" 
                                                             name="card-number">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="card-name">Nome impresso</label>
                                                            <input id="card-name" data-required="true" 
                                                            class="form-control" type="text" name="card-name">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="mes">Data de Expiração</label>
                                                            <input type="text" data-required="true" 
                                                            id="card-expiration" name="card-expiration" 
                                                            class="form-control">
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="cvv">CVV</label>
                                                            <input id="cvv" data-required="true"
                                                             class="form-control" type="text" name="cvv">
                                                        </div>
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="category-fieldset">
                                        <span class="title">Dados de entrega:</span>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="">Nome:</label>
                                                    <input type="text" data-required="true" class="form-control" 
                                                        name="name" id="name" 
                                                        aria-describedby="nameId" placeholder="">
                                                    <small id="nameId" class="form-text text-muted">
                                                        Seu nome.
                                                    </small>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="">Cpf:</label>
                                                    <input type="text" data-required="true" class="form-control" 
                                                        name="cpf" id="cpf" 
                                                        aria-describedby="cpfId" placeholder="">
                                                    <small id="cpfId" class="form-text text-muted">
                                                        Seu cpf.
                                                    </small>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="">cep:</label>
                                                    <input type="text" data-required="true" class="form-control" 
                                                        name="cep" id="cep" 
                                                        aria-describedby="cepId" placeholder="">
                                                    <small id="cepId" class="form-text text-muted">
                                                        Seu cep.
                                                    </small>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="">Endereço:</label>
                                                    <input type="text" data-required="true" class="form-control" 
                                                        name="address" id="address" 
                                                        aria-describedby="addressId" placeholder="">
                                                    <small id="addressId" class="form-text text-muted">
                                                        Sua rua, seu número de apto.
                                                    </small>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                <label for="">Bairro:</label>
                                                <input type="text" data-required="true" class="form-control" name="neighborhood" 
                                                        id="neighborhood" 
                                                        aria-describedby="neighborhoodId" placeholder="">
                                                <small id="neighborhoodId" class="form-text text-muted">Seu bairro</small>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="">Estado:</label>
                                                    <select data-required="true" 
                                                        class="form-control" name="uf" id="uf" 
                                                            aria-describedby="ufId" placeholder="">
                                                        <option value="">Selecione</option>
                                                        
                                                        <?php foreach($model->getStates() as $state ) : ?>
                                                            <option value="<?php echo $state->getId(); ?>">
                                                                <?php echo $state->getName(); ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <small id="ufId" class="form-text text-muted">
                                                        Seu estado
                                                    </small>
                                                </div>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="form-group">
                                                    <label for="">Cidade:</label>
                                                    <input type="text" data-required="true" class="form-control" 
                                                        name="city" id="city" 
                                                            aria-describedby="cityId" placeholder="">
                                                    <small id="cityId" class="form-text text-muted">
                                                        Sua cidade
                                                    </small>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="">Complemento:</label>
                                                    <input type="text" data-required="true" class="form-control" 
                                                            id="complement" name="complement" 
                                                            aria-describedby="complement" placeholder="">


            
                                                    <small id="complementId" class="form-text text-muted">
                                                        Complemento
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- resumo da compra -->
                                <div class="col-md-4">
                                    <div class="list-group list-itens-cart-checkout">
                                        <?php foreach($model->getProducts() as $product ) : ?>
                                            <a href="#" class="list-group-item list-group-item-action bg-default ">
                                                <?php echo $product->getTitle(); ?>
                                            </a>
                                        <?php endforeach; ?>
                                        
                                        <a href="#" class="list-group-item total list-group-item-action bg-success text-white " tabindex="-1" aria-disabled="true">
                                            Total: <?php echo $model->getTotal(); ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <button class="btn btn-block btn-success"
                                        title="Finalizar compra" id="btn-save"
                                        type="submit" data-loading-text="Processando, aguarde...">
                                        Finalizar compra</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </div>
</main>

<?php require_once './views/partials/footer.php' ?>
<script src="js/models/GenericValidator.js"></script>
<script src="js/models/CartCheckout.js"></script>

