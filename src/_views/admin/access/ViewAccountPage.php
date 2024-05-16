<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("utils/htmlDocument.php");
requirm("access/permission.php");
class ViewAccountPage extends BaseHTMLDocumentPage
{
    private Account $account;
    public function __construct(Account $account)
    {
        parent::__construct();
        $this->account = $account;
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
                    <div class="admin-header"><i class="mdi-b apple-keyboard-command admin-header__icon"></i>Xem tài khoản</div>
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
                                        <b>Xem tài khoản</b>
                                        <a type="button" href="/administration/access/account.php" class="btn btn-outline-primary btn-rounded btn-icon">
                                            <i class="mdi-b back"></i> Danh sách tài khoản
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div style="margin-top:24px; margin-bottom:24px;"></div>
                            <div class="row">
                                <div class="col-md-12">
                                    <form>
                                        <div class="mb-3 row">
                                            <label for="uid" class="col-sm-3 col-form-label mx-1"><b>UID</b></label>
                                            <div class="col-sm-8">
                                                <input type="text" readonly class="form-control-plaintext" id="uid" name="uid" placeholder="UID" value="<?= $this->account->getUid() ?>">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="userName" class="col-sm-3 col-form-label mx-1"><b>Tên người dùng</b></label>
                                            <div class="col-sm-8">
                                                <input type="text" readonly class="form-control-plaintext" id="userName" name="userName" placeholder="Tên người dùng" value="<?= $this->account->userName ?>">
                                            </div>
                                        </div>
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
