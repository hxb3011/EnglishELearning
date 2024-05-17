<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("utils/htmlDocument.php");
requirm("access/permission.php");
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
                                        <b class="px-4">
                                            <?= ($this->add) ? "Thêm tài khoản" : "Sửa tài khoản" ?>
                                        </b>
                                        <a type="button" href="/administration/access/account.php" class="btn btn-outline-primary btn-rounded btn-icon">
                                            <i class="mdi-b back"></i> Danh sách tài khoản
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div style="margin-top:24px; margin-bottom:24px;"></div>
                            <div class="row">
                                <div class="col-md-12">
                                    <form id="form_edit_account" action="/administration/access/editAccount.php?add=<?= $this->add ? 1 : 0 ?>&uid=<?= $this->account->getUid() ?>" method="post">
                                        <div class="mb-3 row m-1">
                                            <label for="userName"><b>Tên người dùng</b></label>
                                            <input type="text" class="form-control" id="userName" name="userName" placeholder="Tên người dùng" value="<?= $this->account->userName ?>">
                                        </div>
                                        <div class="mb-3 row m-1">
                                            <label for="password"><b>Mật khẩu</b></label>
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Mật khẩu">
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
                $.validator.addMethod("notEmpty", function(value, element) {
                    return value.trim().length > 0;
                });
                $.validator.addMethod("password", function(value, element) {
                    return (value.length === 0) || (/[a-z]/.test(value) && /[A-Z]/.test(value) && /[0-9]/.test(value) && /[^\w\s]/.test(value));
                });
                //thêm các validate rule cho form
                $("#form_edit_account").validate({
                    ignore: [],
                    onkeyup: function(e) {
                        $(e).valid()
                    },
                    onchange: function(e) {},
                    errorPlacement: function() {},
                    invalidHandler: function() {
                        toastr.error("Vui lòng kiểm tra lại các trường dữ liệu", "Sửa tài khoản : ")
                    },
                    rules: {
                        userName: {
                            required: true,
                            minlength: 6,
                            maxlength: 255,
                            notEmpty: true,
                            remote: {
                                url: '/profile/checkUserName.php',
                                method: 'POST',
                                data: JSON.stringify({ userName: $("#userName").val() }),
                                headers: {
                                    'Access-Control-Allow-Origin': '*' // Thiết lập CORS header cho yêu cầu
                                },
                                success: function(response) {
                                    console.log(this, this.message, response);
                                    if (Number(response) !== 0) {
                                        return true;
                                    }
                                    return false;
                                }
                            }
                        },
                        password: {
                            required: false,
                            minlength: 8,
                            maxlength: 255,
                            password: true,
                        }
                    },
                    messages: {
                        userName: {
                            required: "Vui lòng nhập tên đăng nhập.",
                            minlength: "Tên đăng nhập phải đủ 6 ký tự.",
                            maxlength: "Tên đăng nhập không vượt quá 255 ký tự.",
                            notEmpty: "Vui lòng nhập tên đăng nhập.",
                            remote: "Tên đăng nhập đã tồn tại"
                        },
                        password: {
                            minlength: "Mật khẩu phải đủ 8 ký tự.",
                            maxlength: "Mật khẩu không vượt quá 255 ký tự.",
                            password: "Mật khẩu không hợp lệ.",
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
