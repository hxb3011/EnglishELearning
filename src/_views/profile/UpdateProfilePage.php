<?
require_once "/var/www/html/_lib/utils/requir.php";
requirv("profile/ProfileMainPage.php");

final class UpdateProfilePage extends ProfileMainPage
{
    public function __construct(?IPermissionHolder $holder, array $verifications)
    {
        parent::__construct($holder, $verifications);
    }

    public function head()
    {
        parent::head();
        $this->styles("/clients/css/profile/modal.css");
        $this->scripts("/clients/profile/update.js");
    }

    public function modal()
    {
        $holder = $this->holder;
        if (!isset($holder))
            return;
        $key = $holder->getKey();
        $updateProfile = $key->isPermissionGranted(Permission_ProfileUpdate);
        $updateAccount = $key->isPermissionGranted(Permission_AccountUpdate);
        if (!$updateProfile && !$updateAccount)
            return;
        $readProfile = $key->isPermissionGranted(Permission_ProfileRead);
        $readAccount = $key->isPermissionGranted(Permission_AccountRead);
        ?>
        <form class="modal" action="/profile/update.php" method="post">
            <card class="section">
                <p class="title">Sửa thông tin hồ sơ</p>
                <?
                $profile = null;
                $account = null;
                if ($holder instanceof Account) {
                    $profile = null;
                    $account = $holder;
                } elseif ($holder instanceof Profile) {
                    $profile = $holder;
                    $account = $profile->getAccount();
                }
                if (isset($profile)) {
                    ?>
                    <label for="ilname">Họ</label>
                    <input id="ilname" invalid invalid-isEmpty="Họ không thể bỏ trống!" invalid-isExceed="Họ không thể vượt quá 255 ký tự!" name="lName" placeholder="Họ" required type="text" value="<?= $readProfile ? $profile->lastName : "" ?>">
                    <p class="error">Họ không thể bỏ trống!</p>
                    <label for="ifname">Tên</label>
                    <input id="ifname" invalid invalid-isEmpty="Tên không thể bỏ trống!" invalid-isExceed="Tên không thể vượt quá 255 ký tự!" name="fName" placeholder="Tên" required type="text" value="<?= $readProfile ? $profile->firstName : "" ?>">
                    <p class="error">Tên không thể bỏ trống!</p>
                    <label for="sgender">Giới tính</label>
                    <select id="sgender" name="gender" required>
                        <?
                        $selected = " selected";
                        $maleSelected = "";
                        $femaleSelected = "";
                        if ($readProfile) {
                            if ($profile->gender === Gender_Male)
                                $maleSelected = $selected;
                            else
                                $femaleSelected = $selected;
                        }
                        ?>
                        <option value="<?= Gender_Male ?>"<?= $maleSelected ?>>Nam</option>
                        <option value="<?= Gender_Female ?>"<?= $femaleSelected ?>>Nữ</option>
                    </select>
                    <label for="ibirthday">Ngày sinh</label>
                    <input id="ibirthday" invalid name="birthday" required type="date" value="<?= $readProfile ? $profile->birthday : "2000-01-01" ?>">
                    <p class="error">Ngày sinh không thể bỏ trống!</p>
                    <?
                }
                if (isset($account)) {
                    ?>
                    <label for="iuname">Tên người dùng</label>
                    <input id="iuname" invalid invalid-isEmpty="Tên người dùng không thể bỏ trống!" invalid-isNotReach="Tên người dùng không thể ít hơn 6 ký tự!" invalid-isExceed="Tên người dùng không thể vượt quá 255 ký tự!" invalid-isExisted="Tên người dùng đã tồn tại!" name="uName" placeholder="Tên người dùng" required type="text" value="<?= $readAccount ? $account->userName : "" ?>">
                    <p class="error">Tên người dùng không thể bỏ trống!</p>
                    <?
                }
                ?>
                <input id="iexit" type="reset" value="Thoát">
                <input type="submit" value="Cập nhật">
            </card>
        </form>
        <?
    }
}
?>