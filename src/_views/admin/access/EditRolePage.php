<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("utils/htmlDocument.php");
requirm("access/role.php");
class EditRolePage extends BaseHTMLDocumentPage
{
    private IPermissionHolder $holder;
    private Role $role;
    private bool $add;
    public function __construct(IPermissionHolder $holder, Role $role, bool $add = false)
    {
        parent::__construct();
        $this->holder = $holder;
        $this->role = $role;
        $this->add = $add;
    }

    // public function beforeDocument()
    // {
    //     parent::beforeDocument();
    // }

    public function documentInfo(string $author, string $description, string $title)
    {
        parent::documentInfo($author, $description, "Vai trò - " . $title);
    }

    public function openGraphInfo(string $image, string $description, string $title)
    {
        parent::openGraphInfo($image, $description, "Vai trò - " . $title);
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
                        <?= ($this->add) ? "Thêm vai trò" : "Sửa vai trò" ?>
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
                                            <?= ($this->add) ? "Thêm vai trò" : "Sửa vai trò" ?>
                                        </span>
                                        <a type="button" href="/administration/access/role.php" class="btn btn-outline-primary btn-rounded btn-icon">
                                            <i class="mdi-b back"></i> Danh sách vai trò
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div style="margin-top:24px; margin-bottom:24px;"></div>
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="/administration/access/editRole.php?add=<?= $this->add ? 1 : 0 ?>&roleid=<?= $this->role->getId() ?>" method="post">
                                        <div class="form-group">
                                            <label for="name">Tên</label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Tên" value="<?= $this->role->name ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Danh sách quyền</label>
                                        </div>
                                        <?
                                        $key = $this->role->getKey();
                                        for ($value = PermissionMinValue; $value <= PermissionMaxValue; ++$value) {
                                            $permkey = getPermissionKey($value);
                                            $permname = getPermissionName($value);
                                            $permchecked = $key->isPermissionGranted($value) ? " checked" : "";
                                            ?>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="i<?= $permkey ?>" name="<?= $permkey ?>" value="<?= $value ?>"<?= $permchecked ?>>
                                                <label class="form-check-label" for="i<?= $permkey ?>"><?= $permname ?></label>
                                            </div>
                                            <?
                                        }
                                        ?>
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
