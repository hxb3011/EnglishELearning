<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("utils/htmlDocument.php");
requirm("access/permission.php");
class EditRolePage extends BaseHTMLDocumentPage
{
    private IPermissionHolder $holder;
    private Role $role;
    private int $type;
    private bool $add;
    public function __construct(IPermissionHolder $holder, Role $role, int $type, bool $add = false)
    {
        parent::__construct();
        $this->holder = $holder;
        $this->role = $role;
        $this->type = $type;
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
                                        <b class="px-4">
                                            <?= ($this->add) ? "Thêm vai trò" : "Sửa vai trò" ?>
                                        </b>
                                        <a type="button" href="/administration/access/role.php" class="btn btn-outline-primary btn-rounded btn-icon px-4">
                                            <i class="mdi-b back"></i> Danh sách vai trò
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div style="margin-top:24px; margin-bottom:24px;"></div>
                            <div class="row">
                                <div class="col-md-12">
                                    <form id="form_edit_role" action="/administration/access/editRole.php?add=<?= $this->add ? 1 : 0 ?>&roleid=<?= $this->role->getId() ?>" method="post">
                                        <div class="mb-3 row m-1">
                                            <label for="name" class="mx-1"><b>Tên</b></label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Tên" value="<?= $this->role->name ?>">
                                        </div>
                                        <?
                                        if (!$this->add) {
                                            ?>
                                            <div class="mb-3 row m-1">
                                                <label for="defaulttype" class="mx-1"><b>Tên</b></label>
                                                <?
                                                $selected = " selected";
                                                $unspecified = "";
                                                $instructor = "";
                                                $learner = "";
                                                if ($this->type === ProfileType_Instructor) {
                                                    $instructor = $selected;
                                                } elseif ($this->type === ProfileType_Learner) {
                                                    $learner = $selected;
                                                } else {
                                                    $unspecified = $selected;
                                                }
                                                ?>
                                                <select class="form-control" id="defaulttype" name="defaulttype">
                                                    <option <?= $unspecified ?>>(Không xác định)</option>
                                                    <option value="<?= ProfileType_Instructor ?>"<?= $instructor ?>>Giảng viên</option>
                                                    <option value="<?= ProfileType_Learner ?>"<?= $learner ?>>Học viên</option>
                                                </select>
                                            </div>
                                            <?
                                        }
                                        ?>
                                        <div class="mb-3 row m-1">
                                            <label class="mx-1"><b>Danh sách quyền</b></label>
                                        </div>
                                        <div class="mb-3 row m-1 px-4 align-items-center">
                                            <?
                                            $key = $this->role->getKey();
                                            for ($value = PermissionMinValue; $value <= PermissionMaxValue; ++$value) {
                                                $permkey = getPermissionKey($value);
                                                if($permkey == null) continue;
                                                $permname = getPermissionName($value);
                                                $permchecked = $key->isPermissionGranted($value) ? " checked" : "";
                                                ?>
                                                <div class="form-check form-check-inline col-sm-4 py-1">
                                                    <input class="form-check-input" type="checkbox" id="i<?= $permkey ?>" name="<?= $permkey ?>" value="<?= $value ?>"<?= $permchecked ?>>
                                                    <label class="form-check-label" for="i<?= $permkey ?>"><?= $permname ?></label>
                                                </div>
                                                <?
                                            }
                                            ?>
                                        </div>
                                        <button type="submit" class="btn btn-primary m-1"><?= ($this->add) ? "Thêm" : "Sửa" ?></button>
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
        ?>
        <script>
            $(document).ready(function() {
                // thêm summer note
                $.validator.addMethod("notEmpty", function(value, element) {
                    return value.trim().length > 0;
                })
                //thêm các validate rule cho form
                $("#form_edit_role").validate({
                    ignore: [],
                    onkeyup: function(e) {
                        $(e).valid()
                    },
                    onchange: function(e) {},
                    errorPlacement: function() {},
                    invalidHandler: function() {
                        toastr.error("Vui lòng kiểm tra lại các trường dữ liệu", "Sửa vai trò : ")
                    },
                    rules: {
                        name: {
                            required: true,
                            maxlength: 255,
                            notEmpty: true,
                        }
                    },
                    messages: {
                        name: {
                            required: "Vui lòng nhập tên",
                            maxlength: "Tên không vượt quá 255 ký tự",
                            notEmpty: "Vui lòng nhập tên"
                        }
                    },
                    errorPlacement: function(error, element) {
                        error.insertAfter(element); // Place error message after the input element
                    },
                    submitHandler: function(form) {
                        form.submit()
                    }
                });
            });
        </script>
        <?
    }
}
