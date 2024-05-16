<?
global $fragment_accounts;
global $fragment_account_read;
global $fragment_account_update;
global $fragment_account_delete;
foreach ($fragment_accounts as $key => $value) {
    if ($value instanceof Account && $fragment_account_read) {
        ?>
        <tr>
            <th scope="row"><?= $value->getUid() ?></th>
            <td><?= $value->userName ?></td>
            <td>
                <div class="dropright">
                    <button type="button" class="btn btn-sm btn-outline-primary btn-rounded btn-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="mdi-b dots-vertical"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/administration/access/viewAccount.php?uid=<?= $value->getUid() ?>">Xem tài khoản</a></li>
                        <?
                        if ($fragment_account_update) {
                            ?>
                            <li><a class="dropdown-item" href="/administration/access/editAccount.php?add=0&uid=<?= $value->getUid() ?>">Sửa tài khoản</a></li>
                            <?
                        }
                        if ($fragment_account_delete) {
                            ?>
                            <li><a class="dropdown-item" href="/administration/access/deleteAccount.php?uid=<?= $value->getUid() ?>">Xoá tài khoản</a></li>
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