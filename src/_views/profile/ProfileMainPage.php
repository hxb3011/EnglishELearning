<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("utils/htmlDocument.php");
requirm("profile/profile.php");

const ProfilePageMode_Normal = 0;
const ProfilePageMode_UpdateProfile = 1;
const ProfilePageMode_ChangePassword = 2;
const ProfilePageMode_AddVerification = 3;
const ProfilePageMode_DeletePhone = 4;
const ProfilePageMode_DeleteEmail = 5;

final class ProfileMainPage extends BaseHTMLDocumentPage
{
    private ?IPermissionHolder $holder;
    private int $mode = 0;
    private array $verifications;
    private string $deleteValue;
    public function __construct(?IPermissionHolder $holder, array $verifications, int $mode = ProfilePageMode_Normal, string $deleteValue = "")
    {
        parent::__construct(NAV_PROF);
        $this->holder = $holder;
        $this->verifications = $verifications;
        $this->mode = $mode;
        $this->deleteValue = $deleteValue;
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
            "/clients/css/layout/card.css",
            "/clients/css/profile/main.css"
        );
        if ($this->mode !== ProfilePageMode_Normal) {
            $this->styles("/clients/css/profile/modal.css");
        }
        $this->scripts(
            "/clients/profile/main.js"
        );
        if ($this->mode === ProfilePageMode_UpdateProfile) {
            $this->scripts("/clients/profile/update.js");
        } elseif ($this->mode === ProfilePageMode_ChangePassword) {
            $this->scripts("/clients/profile/updatePassword.js");
        } elseif ($this->mode === ProfilePageMode_AddVerification) {
            $this->scripts("/clients/profile/addVerification.js");
        } elseif ($this->mode === ProfilePageMode_DeletePhone || $this->mode === ProfilePageMode_DeleteEmail) {
            $this->scripts("/clients/profile/deleteVerification.js");
        }
    }

    public function editProfile()
    {
        $holder = $this->holder;
        if (!isset($holder))
            return;
        $key = $holder->getKey();
        $updateProfile = $key->isPermissionGranted(Permission_ProfileUpdate);
        $updateAccount = $key->isPermissionGranted(Permission_AccountUpdate);
        if (!$updateProfile && !$updateAccount)
            return;
        $readProfile = $key->isPermissionGranted(Permission_ProfileRead);
        $readAccount = $key->isPermissionGranted(Permission_AccountRead);
        ?>
        <form class="modal" action="/profile/update.php" method="post">
            <card class="section">
                <p class="title">Sửa thông tin hồ sơ</p>
                <?
                $profile = null;
                $account = null;
                if ($holder instanceof Account) {
                    $profile = null;
                    $account = $holder;
                } elseif ($holder instanceof Profile) {
                    $profile = $holder;
                    $account = $profile->getAccount();
                }
                if (isset($profile)) {
                    ?>
                    <label for="ilname">Họ</label>
                    <input id="ilname" invalid invalid-isEmpty="Họ không thể bỏ trống!" invalid-isExceed="Họ không thể vượt quá 255 ký tự!" name="lName" placeholder="Họ" required type="text" value="<?= $readProfile ? $profile->lastName : "" ?>">
                    <p class="error">Họ không thể bỏ trống!</p>
                    <label for="ifname">Tên</label>
                    <input id="ifname" invalid invalid-isEmpty="Tên không thể bỏ trống!" invalid-isExceed="Tên không thể vượt quá 255 ký tự!" name="fName" placeholder="Tên" required type="text" value="<?= $readProfile ? $profile->firstName : "" ?>">
                    <p class="error">Tên không thể bỏ trống!</p>
                    <label for="sgender">Giới tính</label>
                    <select id="sgender" name="gender" required>
                        <?
                        $selected = " selected";
                        $maleSelected = "";
                        $femaleSelected = "";
                        if ($readProfile) {
                            if ($profile->gender === Gender_Male)
                                $maleSelected = $selected;
                            else
                                $femaleSelected = $selected;
                        }
                        ?>
                        <option value="<?= Gender_Male ?>"<?= $maleSelected ?>>Nam</option>
                        <option value="<?= Gender_Female ?>"<?= $femaleSelected ?>>Nữ</option>
                    </select>
                    <label for="ibirthday">Ngày sinh</label>
                    <input id="ibirthday" invalid name="birthday" required type="date" value="<?= $readProfile ? $profile->birthday : "2000-01-01" ?>">
                    <p class="error">Ngày sinh không thể bỏ trống!</p>
                    <?
                }
                if (isset($account)) {
                    ?>
                    <label for="iuname">Tên người dùng</label>
                    <input id="iuname" invalid invalid-isEmpty="Tên người dùng không thể bỏ trống!" invalid-isNotReach="Tên người dùng không thể ít hơn 6 ký tự!" invalid-isExceed="Tên người dùng không thể vượt quá 255 ký tự!" invalid-isExisted="Tên người dùng đã tồn tại!" name="uName" placeholder="Tên người dùng" required type="text" value="<?= $readAccount ? $account->userName : "" ?>">
                    <p class="error">Tên người dùng không thể bỏ trống!</p>
                    <?
                }
                ?>
                <input id="iexit" type="reset" value="Thoát">
                <input type="submit" value="Cập nhật">
            </card>
        </form>
        <?
    }

    public function changePassword()
    {
        $holder = $this->holder;
        if (!isset($holder))
            return;
        $key = $holder->getKey();
        $updateAccount = $key->isPermissionGranted(Permission_AccountUpdate);
        if (!$updateAccount)
            return;
        ?>
        <form class="modal" action="/profile/updatePassword.php" method="post">
            <card class="section">
                <p class="title">Đổi mật khẩu</p>
                <label for="ipassword">Mật khẩu hiện tại</label>
                <input id="ipassword" invalid-isempty="Mật khẩu không thể bỏ trống!" invalid-isinvalid="Mật khẩu phải gồm ký tự đặc biệt, chữ hoa, thường & số!" invalid-isnotreach="Mật khẩu không thể ít hơn 8 ký tự!" invalid-isexceed="Mật khẩu không thể vượt quá 255 ký tự!" name="password" placeholder="Mật khẩu hiện tại" type="password">
                <p class="error"></p>
                <label for="ixpassword">Mật khẩu mới</label>
                <input id="ixpassword" invalid-isempty="Mật khẩu không thể bỏ trống!" invalid-isinvalid="Mật khẩu phải gồm ký tự đặc biệt, chữ hoa, thường & số!" invalid-isnotreach="Mật khẩu không thể ít hơn 8 ký tự!" invalid-isexceed="Mật khẩu không thể vượt quá 255 ký tự!" invalid-ismatch="Mật khẩu cũ được nhập!" name="xpassword" placeholder="Mật khẩu mới" type="password">
                <p class="error"></p>
                <label for="izpassword">Nhập lại mật khẩu mới</label>
                <input id="izpassword" invalid-isempty="Mật khẩu không thể bỏ trống!" invalid-isinvalid="Mật khẩu phải gồm ký tự đặc biệt, chữ hoa, thường & số!" invalid-isnotreach="Mật khẩu không thể ít hơn 8 ký tự!" invalid-isexceed="Mật khẩu không thể vượt quá 255 ký tự!" invalid-isnotmatch="Mật khẩu không khớp!" name="zpassword" placeholder="Nhập lại mật khẩu mới" type="password">
                <p class="error"></p>
                <input id="iexit" type="reset" value="Thoát">
                <input type="submit" value="Cập nhật">
            </card>
        </form>
        <?
    }

    public function addVerification()
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

    public function deleteEmail()
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

    public function deletePhone()
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

    public function body()
    {
        $holder = $this->holder;
        if (!isset($this->holder)) {
            ?>
            <card class="header">
                <p class="title">Thông tin cá nhân</p>
                <input class="outlined" id="iregister" type="button" value="Đăng ký">
                <input id="isignin" type="button" value="Đăng nhập">
            </card>
            <?
        } else {
            ?>
            <card class="header signed">
                <img class="prof-pic" src="/assets/images/banner-2.png" alt="Ảnh hồ sơ">
                <p class="mdi-b alt-prof-pic"></p>
                <?
                $holder = $this->holder;
                $key = $holder->getKey();
                $name = "Không xác định";
                $type = "Không xác định";
                if ($holder instanceof Account) {
                    if ($key->isPermissionGranted(Permission_AccountRead)) {
                        $name = $holder->userName;
                        $type = "Quản trị viên";
                    }
                } elseif ($holder instanceof Profile) {
                    if ($key->isPermissionGranted(Permission_ProfileRead)) {
                        $name = $holder->lastName . " " . $holder->firstName;
                        $type = $holder->type === ProfileType_Instructor ? "Giảng viên"
                            : ($holder->type === ProfileType_Instructor ? "Học viên"
                                : "Không xác định");
                    }
                }
                ?>
                <p class="name"><?= $name ?></p>
                <p class="type"><?= $type ?><input id="isignout" type="button" value="Đăng xuất"></p>
            </card>
            <?
            $key = $holder->getKey();
            $profile = null;
            $account = null;
            if ($holder instanceof Account) {
                $profile = null;
                $account = $holder;
            } elseif ($holder instanceof Profile) {
                $profile = $holder;
                $account = $profile->getAccount();
            }

            $updateProfile = $key->isPermissionGranted(Permission_ProfileUpdate);
            $updateAccount = $key->isPermissionGranted(Permission_AccountUpdate);
            ?>
            <card class="section profile">
                <div class="list-heading" title="Thông tin hồ sơ">
                    <p class="icon mdi-b"></p>
                    <?
                    if ($updateProfile) {
                        ?>
                        <a class="edit action mdi-b" href="/profile/index.php?o=updateProfile">Sửa</a>
                        <?
                    }
                    ?>
                </div>
                <?
                $voidLink = "javascript:void(0)";
                $updateProfileLink = "/profile/index.php?o=updateProfile";
                if (isset($profile)) {
                    $gender = $profile->gender === Gender_Male ? "Nam" : "Nữ";
                    $birthday = DateTimeImmutable::createFromFormat("Y-m-d", $profile->birthday);
                    $birthday = $birthday !== false ? $birthday->format("d/m/Y") : "01/01/2000";
                    $link = $updateProfile ? $updateProfileLink : $voidLink;
                    ?>
                    <hr>
                    <a class="list-item gender" href="<?= $link ?>" heading="Giới tính" title="<?= $gender ?>">
                        <p class="icon mdi-b"></p>
                        <p class="action mdi-b"></p>
                    </a>
                    <hr>
                    <a class="list-item birthday" href="<?= $link ?>" heading="Ngày sinh" title="<?= $birthday ?>">
                        <p class="icon mdi-b"></p>
                        <p class="action mdi-b"></p>
                    </a>
                    <?
                }
                if (isset($account)) {
                    ?>
                    <hr>
                    <a class="list-item username" href="<?= $updateAccount ? $updateProfileLink : $voidLink ?>" heading="Tên người dùng" title="<?= $account->userName ?>">
                        <p class="icon mdi-b"></p>
                        <p class="action mdi-b"></p>
                    </a>
                    <?
                    if ($updateAccount) {
                        ?>
                        <hr>
                        <a class="list-item password" href="/profile/index.php?o=changePassword" heading="Mật khẩu" title="Đổi mật khẩu">
                            <p class="icon mdi-b"></p>
                            <p class="action mdi-b"></p>
                        </a>
                        <?
                    }
                }
                ?>
            </card>
            <?
            $hasUndefindActions = true;
            $hasCourseSupscriptionHistory = $key->isPermissionGranted(Permission_CourseSubscribe);
            $hasAdministrationAction = $key->isPermissionGranted(Permission_SystemPrivilege) && (!isset($profile) || $profile->type !== ProfileType_Learner);
            $hasRelatedActions = $hasUndefindActions || $hasCourseSupscriptionHistory || $hasAdministrationAction;
            if ($hasRelatedActions) {
                ?>
                <card class="section related">
                    <div class="list-heading" title="Liên kết liên quan">
                        <p class="icon mdi-b"></p>
                    </div>
                    <?
                    if ($hasUndefindActions) {
                        ?>
                        <hr>
                        <a class="list-item" href="#" heading="Scope" title="Action">
                            <p class="icon mdi-b"></p>
                            <p class="action mdi-b"></p>
                        </a>
                        <hr>
                        <a class="list-item" href="#" heading="Scope" title="Action">
                            <p class="icon mdi-b"></p>
                            <p class="action mdi-b"></p>
                        </a>
                        <hr>
                        <a class="list-item" href="#" heading="Scope" title="Action">
                            <p class="icon mdi-b"></p>
                            <p class="action mdi-b"></p>
                        </a>
                        <?
                    }
                    if ($hasCourseSupscriptionHistory) {
                        ?>
                        <hr>
                        <a class="list-item history" href="#" heading="Khoá học" title="Lịch sử đăng ký">
                            <p class="icon mdi-b"></p>
                            <p class="action mdi-b"></p>
                        </a>
                        <?
                    }
                    if ($hasAdministrationAction) {
                        ?>
                        <hr>
                        <a class="list-item administration" href="#" heading="Hệ thống" title="Quản trị hệ thống">
                            <p class="icon mdi-b"></p>
                            <p class="action mdi-b"></p>
                        </a>
                        <?
                    }
                    ?>
                </card>
                <?
            }
            if (isset($profile)) {
                $createVerification = $key->isPermissionGranted(Permission_VerificationCreate);
                $readVerification = $key->isPermissionGranted(Permission_VerificationRead);
                $deleteVerification = $key->isPermissionGranted(Permission_VerificationDelete);
                if ($createVerification || $readVerification) {
                    ?>
                    <card class="section verification">
                        <div class="list-heading" title="Thông tin xác thực">
                            <p class="icon mdi-b"></p>
                            <?
                            if ($createVerification) {
                                ?>
                                <a class="add action mdi-b" href="/profile/index.php?o=addVerification">Thêm</a>
                                <?
                            }
                            ?>
                        </div>
                        <?
                        if ($readVerification) {
                            foreach ($this->verifications as $key => $value) {
                                if (!($value instanceof Verification)) continue;
                                $vclass = "";
                                $vhref = "";
                                $vheading = "";
                                $vtitle = "";
                                $v = $value->getPhone();
                                if (isset($v)) {
                                    $vclass = " phone";
                                    $vhref = "/profile/index.php?o=deletePhone&v=" . $v;
                                    $vheading = "Điện thoại";
                                    $vtitle = $v;
                                } else {
                                    $v = $value->getEmail();
                                    if (isset($v)) {
                                        $vclass = " email";
                                        $vhref = "/profile/index.php?o=deleteEmail&v=" . $v;
                                        $vheading = "Email";
                                        $vtitle = $v;
                                    }
                                }
                                if ($deleteVerification) {
                                    $vhref = $voidLink;
                                }
                                ?>
                                <hr>
                                <a class="list-item<?= $vclass ?>" href="<?= $vhref ?>" heading="<?= $vheading ?>" title="<?= $vtitle ?>">
                                    <p class="icon mdi-b"></p>
                                    <p class="action mdi-b"></p>
                                </a>
                                <?
                            }
                            // <hr>
                            // <a class="list-item phone" href="#" heading="Điện thoại" title="0987654321">
                            //     <p class="icon mdi-b"></p>
                            //     <p class="action mdi-b"></p>
                            // </a>
                            // <hr>
                            // <a class="list-item phone" href="#" heading="Điện thoại" title="0123456789">
                            //     <p class="icon mdi-b"></p>
                            //     <p class="action mdi-b"></p>
                            // </a>
                            // <hr>
                            // <a class="list-item email" href="#" heading="Email" title="some.one.123@example.com">
                            //     <p class="icon mdi-b"></p>
                            //     <p class="action mdi-b"></p>
                            // </a>
                            // <hr>
                            // <a class="list-item email" href="#" heading="Email" title="someone.123@example.com">
                            //     <p class="icon mdi-b"></p>
                            //     <p class="action mdi-b"></p>
                            // </a>
                            // <hr>
                            // <a class="list-item email" href="#" heading="Email" title="xxxxxxxxxxxxxxxxsomeone123@example.com">
                            //     <p class="icon mdi-b"></p>
                            //     <p class="action mdi-b"></p>
                            // </a>
                        }
                        ?>
                    </card>
                    <?
                }
                // TODO:
                ?>
                <card class="section payments">
                    <div class="list-heading" title="Phương thức thanh toán">
                        <p class="icon mdi-b"></p>
                        <a class="add action mdi-b" href="#">Thêm</a>
                    </div>
                    <hr>
                    <a class="list-item wallet" href="#" heading="Mobile Money" title="0xxxxx1234">
                        <p class="icon mdi-b"></p>
                        <p class="action mdi-b"></p>
                    </a>
                    <hr>
                    <a class="list-item wallet" href="#" heading="Zalo Pay" title="0xxxxx1234">
                        <p class="icon mdi-b"></p>
                        <p class="action mdi-b"></p>
                    </a>
                    <hr>
                    <a class="list-item card" href="#" heading="Visa" title="1234xxxx9012">
                        <p class="icon mdi-b"></p>
                        <p class="action mdi-b"></p>
                    </a>
                    <hr>
                    <a class="list-item card" href="#" heading="Master Card" title="1234xxxx4321">
                        <p class="icon mdi-b"></p>
                        <p class="action mdi-b"></p>
                    </a>
                    <hr>
                    <a class="list-item wallet" href="#" heading="VN Pay" title="1234xxxx1234">
                        <p class="icon mdi-b"></p>
                        <p class="action mdi-b"></p>
                    </a>
                </card>
                <?
            }
        }
        ?>
        <card class="section settings">
            <div class="list-heading" title="Cài đặt">
                <p class="icon mdi-b"></p>
            </div>
            <hr>
            <a class="list-item theme" href="#" heading="Scope" title="Action">
                <p class="icon mdi-b"></p>
                <p class="action mdi-b"></p>
            </a>
            <hr>
            <a class="list-item birthday" href="#" heading="Scope" title="Action">
                <p class="icon mdi-b"></p>
                <p class="action mdi-b"></p>
            </a>
            <hr>
            <a class="list-item username" href="#" heading="Scope" title="Action">
                <p class="icon mdi-b"></p>
                <p class="action mdi-b"></p>
            </a>
            <hr>
            <a class="list-item password" href="#" heading="Scope" title="Action">
                <p class="icon mdi-b"></p>
                <p class="action mdi-b"></p>
            </a>
            <hr>
            <a class="list-item password" href="#" heading="Scope" title="Action">
                <p class="icon mdi-b"></p>
                <p class="action mdi-b"></p>
            </a>
        </card>
        <?
        // <card class="section" style="font-size: 32rem;">
        //     <p class="title">profile(firstName, lastName, gender, birthday, type, status, uid, role)</p>
        //     <p class="title">account(username, password, perms, status)</p>
        //     <p class="title">role(name, perms)</p>
        //     <p class="title">verification(profid, key)</p>
        //     <p class="title">payment(id, key, profid)</p>
        // </card>
    }
    public function modal()
    {
        if ($this->mode === ProfilePageMode_UpdateProfile)
            $this->editProfile();
        if ($this->mode === ProfilePageMode_ChangePassword)
            $this->changePassword();
        if ($this->mode === ProfilePageMode_AddVerification)
            $this->addVerification();
        if ($this->mode === ProfilePageMode_DeletePhone)
            $this->deletePhone();
        if ($this->mode === ProfilePageMode_DeleteEmail)
            $this->deleteEmail();
    }
    // public function afterDocument()
    // {
    //     parent::afterDocument();
    // }
}
?>