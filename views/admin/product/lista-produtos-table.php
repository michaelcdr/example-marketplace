
<?php 
    //echo var_dump($products);
?>
<table id="tb-products" data-page="0" class="table table-bordered table-hovered table-striped">
    <thead>
        <tr>
            <th width="10%"></th>
            <th>Image</th>
            <th>Titulo</th>
            <th>Nome</th>
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
                    <td>
                        <div class="btn-group">
                        <?php $product->getId(); ?>
                        </div>
                    </td>
                    <td>
                        
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                </tr>
            <?php endforeach?>
        <?php endif ?>
    </tbody>
</table>