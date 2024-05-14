<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("utils/htmlDocument.php");
requirm("access/account.php");
class EditAccountPage extends BaseHTMLDocumentPage
{
    private IPermissionHolder $holder;
    private Account $account;
    private bool $add;
    public function __construct(IPermissionHolder $holder, Account $account, bool $add = false)
    {
        parent::__construct();
        $this->holder = $holder;
        $this->account = $account;
        $this->add = $add;
    }

    // public function beforeDocument()
    // {
    //     parent::beforeDocument();
    // }

    public function documentInfo(string $author, string $description, string $title)
    {
        parent::documentInfo($author, $description, "Tài khoản - " . $title);
    }

    public function openGraphInfo(string $image, string $description, string $title)
    {
        parent::openGraphInfo($image, $description, "Tài khoản - " . $title);
    }

    public function favIcon(string $ico = null, string $svg = null)
    {
        parent::favIcon($ico, $svg);
    }

    public function head()
    {
        $this->styles(
            "/node_modules/bootstrap/dist/css/bootstrap.min.css",
            "/node_modules/summernote/dist/summernote-bs5.min.css",
            "/node_modules/toastr/build/toastr.css",
            "/node_modules/dragula/dist/dragula.min.css",
            "/node_modules/sweetalert2/dist/sweetalert2.min.css",
            "/clients/css/admin/main.css",
            "/clients/css/admin/addcourse.css"
        );
        $this->scripts(
            "/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js",
        );
    }
    public function body()
    {
        ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="admin-header">
                        <i class="mdi-b apple-keyboard-command admin-header__icon"></i>
                        <?= ($this->add) ? "Thêm tài khoản" : "Sửa tài khoản" ?>
                    </div>
                </div>
            </div>
            <div style="margin-top:10px; margin-bottom:10px"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span>
                                            <?= ($this->add) ? "Thêm tài khoản" : "Sửa tài khoản" ?>
                                        </span>
                                        <a type="button" href="/administration/access/account.php" class="btn btn-outline-primary btn-rounded btn-icon">
                                            <i class="mdi-b back"></i> Danh sách tài khoản
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div style="margin-top:24px; margin-bottom:24px;"></div>
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="/administration/access/editAccount.php?add=<?= $this->add ? 1 : 0 ?>&uid=<?= $this->account->getUid() ?>" method="post">
                                        <div class="form-group">
                                            <label for="userName">Tên người dùng</label>
                                            <input type="text" class="form-control" id="userName" name="userName" placeholder="Tên người dùng" value="<?= $this->account->userName ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Mật khẩu</label>
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Mật khẩu" value="<?= $this->account->password ?>">
                                        </div>
                                        <button type="submit" class="btn btn-primary"><?= ($this->add) ? "Thêm" : "Sửa" ?></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?
        $this->scripts(
            "/node_modules/jquery/dist/jquery.min.js",
            "/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js",
            "/node_modules/jquery-validation/dist/jquery.validate.min.js",
            "/node_modules/summernote/dist/summernote-bs5.min.js",
            "/node_modules/dragula/dist/dragula.min.js",
            "/node_modules/toastr/build/toastr.min.js",
            "/node_modules/sweetalert2/dist/sweetalert2.min.js",
            "/clients/js/admin/main.js",
        );
    }
}