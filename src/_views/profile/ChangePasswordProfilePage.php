<?
require_once "/var/www/html/_lib/utils/requir.php";
requirv("profile/ProfileMainPage.php");

final class ChangePasswordProfilePage extends ProfileMainPage
{
    public function __construct(?IPermissionHolder $holder, array $verifications)
    {
        parent::__construct($holder, $verifications);
    }

    public function head()
    {
        parent::head();
        $this->styles("/clients/css/profile/modal.css");
        $this->scripts("/clients/profile/updatePassword.js");
    }

    public function modal()
    {
        $holder = $this->holder;
        if (!isset($holder))
            return;
        $key = $holder->getKey();
        $updateAccount = $key->isPermissionGranted(Permission_AccountUpdate);
        if (!$updateAccount)
            return;
        ?>
        <form class="modal" action="/profile/updatePassword.php" method="post">
            <card class="section">
                <p class="title">Đổi mật khẩu</p>
                <label for="ipassword">Mật khẩu hiện tại</label>
                <input id="ipassword" invalid-isempty="Mật khẩu không thể bỏ trống!" invalid-isinvalid="Mật khẩu phải gồm ký tự đặc biệt, chữ hoa, thường & số!" invalid-isnotreach="Mật khẩu không thể ít hơn 8 ký tự!" invalid-isexceed="Mật khẩu không thể vượt quá 255 ký tự!" name="password" placeholder="Mật khẩu hiện tại" type="password">
                <p class="error"></p>
                <label for="ixpassword">Mật khẩu mới</label>
                <input id="ixpassword" invalid-isempty="Mật khẩu không thể bỏ trống!" invalid-isinvalid="Mật khẩu phải gồm ký tự đặc biệt, chữ hoa, thường & số!" invalid-isnotreach="Mật khẩu không thể ít hơn 8 ký tự!" invalid-isexceed="Mật khẩu không thể vượt quá 255 ký tự!" invalid-ismatch="Mật khẩu cũ được nhập!" name="xpassword" placeholder="Mật khẩu mới" type="password">
                <p class="error"></p>
                <label for="izpassword">Nhập lại mật khẩu mới</label>
                <input id="izpassword" invalid-isempty="Mật khẩu không thể bỏ trống!" invalid-isinvalid="Mật khẩu phải gồm ký tự đặc biệt, chữ hoa, thường & số!" invalid-isnotreach="Mật khẩu không thể ít hơn 8 ký tự!" invalid-isexceed="Mật khẩu không thể vượt quá 255 ký tự!" invalid-isnotmatch="Mật khẩu không khớp!" name="zpassword" placeholder="Nhập lại mật khẩu mới" type="password">
                <p class="error"></p>
                <input id="iexit" type="reset" value="Thoát">
                <input type="submit" value="Cập nhật">
            </card>
        </form>
        <?
    }
}
?>