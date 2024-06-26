<?
global $fragment_profiles;
global $fragment_profile_read;
global $fragment_profile_update;
global $fragment_profile_delete;
foreach ($fragment_profiles as $key => $value) {
    if ($value instanceof Profile && $fragment_profile_read) {
        ?>
        <tr>
            <th scope="row"><?= $value->getId() ?></th>
            <td><?= $value->lastName ?> <?= $value->firstName ?></td>
            <td><?= $value->gender === Gender_Female ? "Nữ" : ($value->gender === Gender_Male ? "Nam" : "") ?></td>
            <?
            $birthday = DateTimeImmutable::createFromFormat("Y-m-d", $value->birthday);
            $birthday = $birthday !== false ? $birthday->format("d/m/Y") : "01/01/2000";
            ?>
            <td><?= $birthday ?></td>
            <td><?= $value->type === ProfileType_Learner ? "Học viên" : ($value->type === ProfileType_Instructor ? "Giảng viên" : "") ?></td>
            <td>
                <div class="dropright">
                    <button type="button" class="btn btn-sm btn-outline-primary btn-rounded btn-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="mdi-b dots-vertical"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/administration/profile/view.php?profileid=<?= $value->getId() ?>">Xem hồ sơ</a></li>
                        <?
                        if ($fragment_profile_update) {
                            ?>
                            <li><a class="dropdown-item" href="/administration/profile/edit.php?add=0&profileid=<?= $value->getId() ?>">Sửa hồ sơ</a></li>
                            <?
                        }
                        if ($fragment_profile_delete) {
                            ?>
                            <li><a class="dropdown-item" href="/administration/profile/delete.php?profileid=<?= $value->getId() ?>">Xoá hồ sơ</a></li>
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