
<?php 
    //echo var_dump($products);
?>
<table id="tb-products" data-page="0" class="table table-bordered table-hovered table-striped">
    <thead>
        <tr>
            <th width="10%"></th>
            <th>Image</th>
            <th>Sku</th>
            <th>Título</th>
        </tr>
    </thead>
    <tbody>
        <?php  if (count($products) == 0) : ?>
            <tr>
                <td colspan="3">Nenhum registro cadastrado.</td>
            </tr>
        <?php else  :?>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td align="align-middle">
                        <div class="btn-group">
                            <button class="btn btn-sm btn-outline-danger btn-delete" data-id="<?php echo $product->getId(); ?>">
                                <i class="fa fa-remove"></i>
                            </button>
                            <a class="btn btn-sm btn-outline-dark" href="/admin/produtos/editar?id=<?php echo $product->getId(); ?>">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a class="btn btn-sm btn-outline-dark" href="/admin/produtos/detalhes?id=<?php echo $product->getId(); ?>">
                                <i class="fa fa-list"></i>
                            </a>
                        </div>
                    </td>
                    <td align="center" >
                        <img src="<?php echo $product->getDefaultImage(); ?>" 
                            title="" alt="" class="img-fluid" style="max-width:100px; max-height:100px; ">
                        
                    </td>
                    <td >
                        <?php echo $product->getSku(); ?>
                    </td>
                    <td >
                        <?php echo $product->getTitle(); ?>
                    </td>
                </tr>
            <?php endforeach?>
        <?php endif ?>
    </tbody>
</table>