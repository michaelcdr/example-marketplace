<table id="tb-sellers" data-page="0" class="table table-bordered table-hovered table-striped">
    <thead>
        <tr>
            <th width="10%"></th>
            <th>Login</th>
            <th>Nome</th>
            <th>Sobrenome</th>
            <th>Nome fantasia</th>
            <th>Cidade</th>
        </tr>
    </thead>
    <tbody>
        <?php  if (count($sellers) == 0) : ?>
            <tr>
                <td colspan="4">Nenhum registro cadastrado.</td>
            </tr>
        <?php else  :?>
            <?php foreach ($sellers as $seller): ?>
                <tr>
                    <td>
                        <div class="btn-group">
                            <button class='btn btn-sm btn-outline-danger btn-delete' 
                                data-id="<?php echo $seller->getSellerId(); ?>">
                                <i class="fa fa-remove"></i>
                            </button>
                            <a class='btn btn-sm btn-outline-dark' 
                                href="/admin/vendedor/editar?id=<?php echo $seller->getSellerId(); ?>">
                                <i class="fa fa-edit" ></i>
                            </a>
                        </div>
                    </td>
                    <td><?php echo $seller->getLogin(); ?></td>
                    <td><?php echo $seller->getName(); ?></td>
                    <td><?php echo $seller->getLastName(); ?></td>
                    <td><?php echo $seller->getFantasyName(); ?></td>
                    <td><?php echo  $seller->getCity(); ?></td>
                </tr>
            <?php endforeach?>
        <?php endif ?>
    </tbody>
</table>