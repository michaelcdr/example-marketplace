<table id="tb-users" data-page="0" class="table table-bordered table-hovered table-striped">
    <thead>
        <tr>
            <th width="15px"></th>
            <th>Data</th>
            <th>Total</th>
            <th>Nº Pedido</th>
        </tr>
    </thead>
    <tbody>
        <?php  if (count($compras) == 0) : ?>
            <tr>
                <td colspan="4">Nenhum registro cadastrado.</td>
            </tr>
        <?php else  :?>
            <?php foreach ($compras as $compra): ?>
                <tr>
                    <td>
                        <div class="btn-group">
                            <a class='btn btn-sm btn-outline-dark' 
                                href="/admin/usuario/pedido?id=<?php echo $compra->getUserId(); ?>">
                                <i class="fa fa-list" ></i>
                            </a>
                        </div>
                    </td>
                    <td>
                        <?php echo $compra->getCreateAtFormatted(); ?>
                    </td>
                    <td>
                        <?php echo $compra->getTotalFormatted(); ?>
                    </td>
                    
                    <td>
                        <?php  echo $compra->getOrderId();  ?>
                    </td>
                </tr>
            <?php endforeach?>
        <?php endif ?>
    </tbody>
</table>