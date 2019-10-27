<table id="tb-users" data-page="0" class="table table-bordered table-hovered table-striped">
    <thead>
        <tr>
            <th width="10%"></th>
            <th>Login</th>
            <th>Nome</th>
        </tr>
    </thead>
    <tbody>
        <?php  if (count($users) == 0) : ?>
            <tr>
                <td colspan="3">Nenhum registro cadastrado.</td>
            </tr>
        <?php else  :?>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td>
                        <div class="btn-group">
                            <button class='btn btn-sm btn-outline-danger btn-delete' 
                                data-id="<?php echo $user["UserId"] ?>">
                                <i class="fa fa-remove"></i>
                            </button>
                            <a class='btn btn-sm btn-outline-dark' 
                                href="/admin/editar-usuario?id=<?php echo $user["UserId"] ?>">
                                <i class="fa fa-edit" ></i>
                            </a>
                        </div>
                    </td>
                    <td>
                        <?php echo $user["Login"] ?>
                    </td>
                    <td>
                        <?php echo $user["Name"] ?>
                    </td>
                </tr>
            <?php endforeach?>
        <?php endif ?>
    </tbody>
</table>