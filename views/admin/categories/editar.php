<?php require_once './views/partials/header-admin.php' ?>

<div class="container">
    <div class="d-flex align-items-center p-3 mt-3 text-white-50 bg-dark rounded shadow-sm">
        <div class="lh-100">
            <h6 class="mb-0 text-white lh-100">Edição de categoria</h6>
            <small>Categorias > Editar</small>
        </div>
        
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <form action="/admin/categoria/editar-post" method="post" id="formCategories" >
                <h5>Informe os dados da categoria e clique em salvar.</h6>
                <input type="hidden" value="<?php echo $category->getCategoryId(); ?>" 
                    name="categoryId" id="categoryId"  > 

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="title">Nome:</label>
                            <input type="text" name="title" id="title"
                                data-required="true" value="<?php echo $category->getTitle(); ?>"
                                class="form-control" placeholder="" aria-describedby="help-title">
                            <small id="help-title" class="text-muted">Nome da categoria</small>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <a class="btn btn-sm btn-warning" href="/admin/categoria">
                            <i class="fa fa-chevron-left"></i>
                        </a>
                        <button type="submit" name="btn-salvar" id="btn-salvar" 
                            class="btn btn-sm btn-dark"><i class="fa fa-save"></i> Salvar categoria
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once './views/partials/scripts-admin.php' ?>
<script src="/js/models/CategoryForm.js"></script>
<?php require_once './views/partials/footer-admin.php' ?>