<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("utils/htmlDocument.php");
requirm("profile/profile.php");
class ViewProfilePage extends BaseHTMLDocumentPage
{
    private Profile $profile;
    public function __construct(Profile $profile)
    {
        parent::__construct();
        $this->profile = $profile;
    }

    // public function beforeDocument()
    // {
    //     parent::beforeDocument();
    // }

    public function documentInfo(string $author, string $description, string $title)
    {
        parent::documentInfo($author, $description, "Hồ sơ - " . $title);
    }

    public function openGraphInfo(string $image, string $description, string $title)
    {
        parent::openGraphInfo($image, $description, "Hồ sơ - " . $title);
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
                    <div class="admin-header"><i class="mdi-b apple-keyboard-command admin-header__icon"></i>Xem hồ sơ</div>
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
                                        <b>Xem hồ sơ</b>
                                        <a type="button" href="/administration/profile/index.php" class="btn btn-outline-primary btn-rounded btn-icon">
                                            <i class="mdi-b back"></i> Danh sách hồ sơ
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div style="margin-top:24px; margin-bottom:24px;"></div>
                            <div class="row">
                                <div class="col-md-12">
                                    <form>
                                        <div class="mb-3 row">
                                            <label for="id" class="col-sm-3 col-form-label mx-1"><b>ID</b></label>
                                            <div class="col-sm-8">
                                                <input type="text" readonly class="form-control-plaintext" id="id" name="id" placeholder="ID" value="<?= $this->profile->getId() ?>">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="lastName" class="col-sm-3 col-form-label mx-1"><b>Họ</b></label>
                                            <div class="col-sm-8">
                                                <input type="text" readonly class="form-control-plaintext" id="lastName" name="lastName" placeholder="Họ" value="<?= $this->profile->lastName ?>">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="firstName" class="col-sm-3 col-form-label mx-1"><b>Tên</b></label>
                                            <div class="col-sm-8">
                                                <input type="text" readonly class="form-control-plaintext" id="firstName" name="firstName" placeholder="Tên" value="<?= $this->profile->firstName ?>">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="gender" class="col-sm-3 col-form-label mx-1"><b>Giới tính</b></label>
                                            <?
                                            if ($this->profile->gender === Gender_Male) {
                                                $gender = "Nam";
                                            } elseif ($this->profile->gender === Gender_Female) {
                                                $gender = "Nữ";
                                            } else {
                                                $gender = "(Không xác định)";
                                            }
                                            ?>
                                            <div class="col-sm-8">
                                                <input type="text" readonly class="form-control-plaintext" id="gender" name="gender"  placeholder="Giới tính" value="<?= $gender ?>">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="birthday" class="col-sm-3 col-form-label mx-1"><b>Ngày sinh</b></label>
                                            <div class="col-sm-8">
                                                <input type="date" readonly class="form-control-plaintext" id="birthday" name="birthday" placeholder="Ngày sinh" value="<?= $this->profile->birthday ?>">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="profileType" class="col-sm-3 col-form-label mx-1"><b>Loại hồ sơ</b></label>
                                            <div class="col-sm-8">
                                                <input type="text" readonly class="form-control-plaintext" id="profileType" name="profileType" placeholder="Loại hồ sơ" value="<?= ($this->profile->type === ProfileType_Instructor) ? "Giảng viên" : "Học viên" ?>">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="account" class="col-sm-3 col-form-label mx-1"><b>Tài khoản</b></label>
                                            <?
                                            $account = $this->profile->getAccount();
                                            if (isset($account)) $account = $account->userName;
                                            else $account = "(Không xác định)";
                                            ?>
                                            <div class="col-sm-8">
                                                <input type="text" readonly class="form-control-plaintext" id="account" name="account" placeholder="Tài khoản" value="<?= $account ?>">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="role" class="col-sm-3 col-form-label mx-1"><b>Vai trò</b></label>
                                            <?
                                            $role = $this->profile->getRole();
                                            if (isset($role)) $role = $role->name;
                                            else $role = "(Không xác định)";
                                            ?>
                                            <div class="col-sm-8">
                                                <input type="text" readonly class="form-control-plaintext" id="role" name="role" placeholder="Vai trò" value="<?= $role ?>">
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
