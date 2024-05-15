<?
require_once "/var/www/html/_lib/utils/requir.php";
requirv("profile/ProfileMainPage.php");
final class AddVerificationProfilePage extends ProfileMainPage
{
    public function __construct(?IPermissionHolder $holder, array $verifications)
    {
        parent::__construct($holder, $verifications);
    }

    public function head()
    {
        parent::head();
        $this->styles("/clients/css/profile/modal.css");
        $this->scripts("/clients/profile/addVerification.js");
    }

    public function modal()
    {
        $holder = $this->holder;
        if (!isset($holder))
            return;
        $key = $holder->getKey();
        $addVerification = $key->isPermissionGranted(Permission_VerificationCreate);
        if (!$addVerification)
            return;
        ?>
        <form class="modal" action="/profile/addVerification.php" method="post">
            <card class="section">
                <p class="title">Thêm xác thực</p>
                <label for="stype">Loại thông tin</label>
                <select name="verificationtype" id="stype" required>
                    <option value="phone">Số điện thoại</option>
                    <option value="email">Email</option>
                </select>
                <label for="ivalue">Số điện thoại</label>
                <input id="ivalue" invalid-phone-isempty="Số điện thoại không thể bỏ trống!" invalid-phone-isnotreach="Số điện thoại không thể ít hơn 10 ký tự!" invalid-phone-isexceed="Số điện thoại không thể vượt quá 11 ký tự!" invalid-phone-isinvalid="Số điện thoại không hợp lệ!" invalid-email-isempty="Email không thể bỏ trống!" invalid-email-isnotreach="Tên Email không thể ít hơn 6 ký tự!" invalid-email-isexceed="Email không thể vượt quá 254 ký tự!" invalid-email-isinvalid="Email không hợp lệ!" name="value" placeholder="Số điện thoại" placeholder-phone="Số điện thoại" placeholder-email="Email" type="text" verification>
                <p class="error"></p>
                <input id="iexit" type="reset" value="Thoát">
                <input type="submit" value="Cập nhật">
            </card>
        </form>
        <?
    }
}
?>