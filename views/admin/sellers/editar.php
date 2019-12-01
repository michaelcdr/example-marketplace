<?php require_once './views/partials/header-admin.php' ?>

<div class="container">
    <div class="d-flex align-items-center p-3 mt-3 text-white-50 bg-dark rounded shadow-sm">
        <div class="lh-100">
            <h6 class="mb-0 text-white lh-100">Edição de vendedor</h6>
            <ul class="nav-breadcrumb">
                <li>
                    <a href="/admin/vendedor">Lista de vendedores</a>
                </li>
                <li>
                    <a href="/admin/vendedor/editar?id=<?php echo $seller->getSellerId(); ?>">Editar vendedor</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <form action="/admin/vendedor/editar-post" method="post" id="formCategories" >
                <h5>Informe os dados do vendedor e clique em salvar.</h6>
                <div class="row">
                    <div class="col-md-12">
                        Tipo: <?php echo $seller->getType(); ?>
                    </div>    

                    <input type="hidden" name="sellerId" id="sellerId" value="<?php echo $seller->getSellerId(); ?>">
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">Nome:</label>
                            <input type="text" name="name" id="name"
                                data-required="true" value="<?php echo $seller->getName(); ?>"
                                class="form-control" placeholder="" aria-describedby="helpId">
                            <small id="help-name" class="text-muted">Nome do usuário</small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="lastName">Nome:</label>
                            <input type="text" name="lastName" id="lastName"
                                data-required="true" value="<?php echo $seller->getLastName(); ?>"
                                class="form-control" placeholder="" aria-describedby="help-lastName">
                            <small id="help-lastName" class="text-muted">Nome do usuário</small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="age">Idade:</label>
                            <input type="number" name="age" id="age"
                                data-required="true" value="<?php echo $user->getAge(); ?>"
                                class="form-control" placeholder="" aria-describedby="help-age">
                            <small id="help-age" class="text-muted">Idade do vendedor</small>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="cpf">CPF:</label>
                            <input type="text" name="cpf" id="cpf"
                                data-required="true" value="<?php echo $user->getCpf(); ?>"
                                class="form-control" placeholder="" aria-describedby="help-cpf">
                            <small id="help-cpf" class="text-muted">CPF do vendedor</small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="cep">Cep:</label>
                            <input type="text" name="cep" id="cep"
                                data-required="true" value="<?php echo $user->getCep(); ?>"
                                class="form-control" placeholder="" aria-describedby="help-cep">
                            <small id="help-cep" class="text-muted">CEP do vendedor</small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="cnpj">CNPJ:</label>
                            <input type="text" name="cnpj" id="cnpj" data-tipo="pj"
                                data-required="true" value="<?php echo $user->getCnpj(); ?>"
                                class="form-control" placeholder="" aria-describedby="help-cnpj">
                            <small id="help-cep" class="text-muted">CNPJ do vendedor</small>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="cnpj">CNPJ:</label>
                            <input type="text" name="cnpj" id="cnpj" data-tipo="pj"
                                placeholder="99.999.999/9999-99"
                                data-required="true" value="<?php echo $user->getCnpj(); ?>"
                                class="form-control" placeholder="" aria-describedby="help-cnpj">
                            <small id="help-cep" class="text-muted">CNPJ do vendedor</small>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <a class="btn btn-warning btn-sm " href="/admin/vendedor">
                            <i class="fa fa-chevron-left"></i>
                        </a>
                        <button type="submit" name="btn-salvar" id="btn-salvar" 
                            class="btn btn-dark btn-sm "><i class="fa fa-save"></i> Salvar vendedor
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once './views/partials/scripts-admin.php' ?>
<script src="/js/models/SellerForm.js"></script>
<?php require_once './views/partials/footer-admin.php' ?>