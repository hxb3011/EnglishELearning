<?
require_once "/var/www/html/_lib/utils/requir.php";
requirv("profile/ProfileMainPage.php");

final class DeleteEmailProfilePage extends ProfileMainPage
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
        $readVerification = $key->isPermissionGranted(Permission_VerificationRead);
        $deleteVerification = $key->isPermissionGranted(Permission_VerificationDelete);
        if (!$readVerification || !$deleteVerification)
            return;
        ?>
        <form class="modal" action="/profile/deleteVerification.php" method="post">
            <card class="section">
                <p class="title">Email</p>
                <label for="iemail">Email được chọn</label>
                <input id="iemail" name="email" readonly type="text" value="<?= $this->deleteValue ?>">
                <input id="iexit" type="reset" value="Thoát">
                <input type="submit" value="Xoá">
            </card>
        </form>
        <?
    }
}
?>