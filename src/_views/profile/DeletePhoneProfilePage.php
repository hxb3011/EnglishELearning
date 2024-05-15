<?
require_once "/var/www/html/_lib/utils/requir.php";
requirv("profile/ProfileMainPage.php");
final class DeletePhoneProfilePage extends ProfileMainPage
{
    private string $deleteValue;
    public function __construct(?IPermissionHolder $holder, array $verifications, string $deleteValue)
    {
        parent::__construct($holder, $verifications);
        $this->deleteValue = $deleteValue;
    }
    
    public function head()
    {
        parent::head();
        $this->styles("/clients/css/profile/modal.css");
        $this->scripts("/clients/profile/deleteVerification.js");
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
        <form class="modal" action="/profile/deleteVerification.php" method="post">
            <card class="section">
                <p class="title">Điện thoại</p>
                <label for="iphone">Điện thoại được chọn</label>
                <input id="iphone" name="phone" readonly type="text" value="<?= $this->deleteValue ?>">
                <input id="iexit" type="reset" value="Thoát">
                <input type="submit" value="Xoá">
            </card>
        </form>
        <?
    }
}
?>