<?
global $fragment_roles;
global $fragment_role_read;
global $fragment_role_update;
global $fragment_role_delete;
foreach ($fragment_roles as $key => $value) {
    if ($value instanceof Role && $fragment_role_read) {
        ?>
        <tr>
            <th scope="row"><?= $value->getId() ?></th>
            <td><?= $value->name ?></td>
            <td>
                <div class="dropright">
                    <button type="button" class="btn btn-sm btn-outline-primary btn-rounded btn-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="mdi-b dots-vertical"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="javascript:void(0)" target="_blank">Xem vai trò</a></li>
                        <?
                        if ($fragment_role_update) {
                            ?>
                            <li><a class="dropdown-item" href="/administration/access/editRole.php?add=1&roleid=<?= $value->getId() ?>">Sửa vai trò</a></li>
                            <?
                        }
                        ?>
                    </ul>
                </div>
            </td>
        </tr>
        <?
    }
}
?>