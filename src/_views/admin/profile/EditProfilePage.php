<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("utils/htmlDocument.php");
requirm("profile/profile.php");
class EditProfilePage extends BaseHTMLDocumentPage
{
    private IPermissionHolder $holder;
    private Profile $profile;
    private array $accounts;
    private array $roles;
    private bool $add;
    public function __construct(IPermissionHolder $holder, Profile $profile, array $accounts, array $roles, bool $add = false)
    {
        parent::__construct();
        $this->holder = $holder;
        $this->profile = $profile;
        $this->accounts = $accounts;
        $this->roles = $roles;
        $this->add = $add;
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
                    <div class="admin-header">
                        <i class="mdi-b apple-keyboard-command admin-header__icon"></i>
                        <?= ($this->add) ? "Thêm hồ sơ" : "Sửa hồ sơ" ?>
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
                                        <b class="mx-1">
                                            <?= ($this->add) ? "Thêm hồ sơ" : "Sửa hồ sơ" ?>
                                        </b>
                                        <a type="button" href="/administration/profile/index.php" class="btn btn-outline-primary btn-rounded btn-icon">
                                            <i class="mdi-b back"></i> Danh sách hồ sơ
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div style="margin-top:24px; margin-bottom:24px;"></div>
                            <div class="row">
                                <div class="col-md-12">
                                    <form id="form_edit_profile" action="/administration/profile/edit.php?add=<?= $this->add ? 1 : 0 ?>&profileid=<?= $this->profile->getId() ?><?= !$this->add ? "&profiletype=" . $this->profile->type : "" ?>" method="post">
                                        <div class="form-group m-1">
                                            <label for="lastName" class="mx-1"><b>Họ</b></label>
                                            <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Họ" value="<?= $this->profile->lastName ?>">
                                        </div>
                                        <div class="form-group m-1">
                                            <label for="firstName" class="mx-1"><b>Tên</b></label>
                                            <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Tên" value="<?= $this->profile->firstName ?>">
                                        </div>
                                        <div class="form-group m-1">
                                            <label for="gender" class="mx-1"><b>Giới tính</b></label>
                                            <select class="form-control" id="gender" name="gender">
                                                <?
                                                $selected = " selected";
                                                $male = "";
                                                $female = "";
                                                $unspecified = "";
                                                if ($this->profile->gender === Gender_Male) {
                                                    $male = $selected;
                                                } elseif ($this->profile->gender === Gender_Female) {
                                                    $female = $selected;
                                                } else {
                                                    $unspecified = $selected;
                                                }
                                                ?>
                                                <option value="<?= Gender_Unspecified ?>"<?= $unspecified ?>>(Không xác định)</option>
                                                <option value="<?= Gender_Male ?>"<?= $male ?>>Nam</option>
                                                <option value="<?= Gender_Female ?>"<?= $female ?>>Nữ</option>
                                            </select>
                                        </div>
                                        <div class="form-group m-1">
                                            <label for="birthday" class="mx-1"><b>Ngày sinh</b></label>
                                            <input type="date" class="form-control" id="birthday" name="birthday" placeholder="Ngày sinh" value="<?= $this->profile->birthday ?>">
                                        </div>
                                        <?
                                        if ($this->add) {
                                           ?>
                                            <div class="form-group m-1">
                                                <label for="profiletype" class="mx-1"><b>Loại hồ sơ</b></label>
                                                <select class="form-control" id="profiletype" name="profiletype"<?= ($this->add) ? "" : " readonly" ?>>
                                                    <?
                                                    $selected = " selected";
                                                    $instructor = "";
                                                    $learner = "";
                                                    if ($this->profile->type === ProfileType_Learner) {
                                                        $learner = $selected;
                                                    } elseif ($this->profile->type === ProfileType_Instructor) {
                                                        $instructor = $selected;
                                                    }
                                                    ?>
                                                    <option value="<?= ProfileType_Instructor ?>"<?= $instructor ?>>Giảng viên</option>
                                                    <option value="<?= ProfileType_Learner ?>"<?= $learner ?>>Học viên</option>
                                                </select>
                                            </div>
                                            <?
                                        }
                                        ?>
                                        <div class="form-group m-1">
                                            <label for="account" class="mx-1"><b>Tài khoản</b></label>
                                            <select class="form-control" id="account" name="account">
                                                <?
                                                $account = $this->profile->getAccount();
                                                if (!isset($account)) {
                                                    $noneSelected = " selected";
                                                } else {
                                                    $noneSelected = "";
                                                }
                                                ?>
                                                <option value=""<?= $noneSelected ?>>(Không xác định)</option>
                                                <?
                                                foreach ($this->accounts as $key => $value) {
                                                    if ($value instanceof Account) {
                                                        if (isset($account) && $account->getUid() === $value->getUid()) {
                                                            $valueSelected = " selected";
                                                        } else {
                                                            $valueSelected = "";
                                                        }
                                                        ?>
                                                        <option value="<?= $value->getUid() ?>"<?= $valueSelected ?>><?= $value->userName ?></option>
                                                        <?
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group m-1">
                                            <label for="role" class="mx-1"><b>Vai trò</b></label>
                                            <select class="form-control" id="role" name="role">
                                                <?
                                                $role = $this->profile->getRole();
                                                foreach ($this->roles as $key => $value) {
                                                    if ($value instanceof Role) {
                                                        if (isset($role) && $role->getId() === $value->getId()) {
                                                            $valueSelected = " selected";
                                                        } else {
                                                            $valueSelected = "";
                                                        }
                                                        ?>
                                                        <option value="<?= $value->getId() ?>"<?= $valueSelected ?>><?= $value->name ?></option>
                                                        <?
                                                    }
                                                }
                                                ?>
                                            </select>
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
                $("#form_edit_profile").validate({
                    ignore: [],
                    onkeyup: function(e) {
                        $(e).valid()
                    },
                    onchange: function(e) {},
                    errorPlacement: function() {},
                    invalidHandler: function() {
                        toastr.error("Vui lòng kiểm tra lại các trường dữ liệu", "Sửa hồ sơ : ")
                    },
                    rules: {
                        lastName: {
                            required: true,
                            maxlength: 255,
                            notEmpty: true,
                        },
                        firstName: {
                            required: true,
                            maxlength: 255,
                            notEmpty: true,
                        },
                        gender: {
                            required: true
                        },
                        birthday: {
                            required: true
                        },
                        profiletype: {
                            required: true
                        },
                        role: {
                            required : true
                        }
                    },
                    messages: {
                        lastName: {
                            required: "Vui lòng nhập họ.",
                            maxlength: "Họ không vượt quá 255 ký tự.",
                            notEmpty: "Vui lòng nhập họ."
                        },
                        firstName: {
                            required: "Vui lòng nhập tên.",
                            maxlength: "Tên không vượt quá 255 ký tự.",
                            notEmpty: "Vui lòng nhập tên."
                        },
                        gender: {
                            required: "Vui lòng chọn giới tính."
                        },
                        birthday: {
                            required: "Vui lòng chọn ngày sinh."
                        },
                        profiletype: {
                            required: "Vui lòng chọn loại hồ sơ."
                        },
                        role: {
                            required : "Vui lòng chọn vai trò."
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
