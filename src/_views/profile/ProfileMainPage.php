<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("utils/htmlDocument.php");
requirm("profile/profile.php");

const ProfilePageMode_Normal = 0;
const ProfilePageMode_UpdateProfile = 0;
const ProfilePageMode_ChangePassword = 0;
final class ProfileMainPage extends BaseHTMLDocumentPage
{
    private ?IPermissionHolder $holder;
    private int $mode = 0;
    public function __construct(?IPermissionHolder $holder, int $mode = ProfilePageMode_Normal)
    {
        parent::__construct(NAV_PROF);
        $this->holder = $holder;
        $this->mode = $mode;
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
        if ($this->mode !== ProfilePageMode_Normal)
        {
            $this->styles("/clients/css/profile/modal.css");
        }
        $this->scripts(
            "/clients/profile/main.js"
        );
    }

    public function signedInHeader() {
        ?>
        <card class="header signed">
            <img class="prof-pic" src="/assets/images/banner-2.png" alt="Ảnh hồ sơ">
            <p class="mdi-b alt-prof-pic"></p>
            <?
            $holder = $this->holder;
            $key = $holder->getKey();
            $name = "Không xác định";
            $type = "Không xác định";
            if ($holder instanceof Account)
            {
                if ($key->isPermissionGranted(Permission_AccountRead)) {
                    $name = $holder->userName;
                    $type = "Quản trị viên";
                }
            }
            elseif ($holder instanceof Profile)
            {
                if ($key->isPermissionGranted(Permission_ProfileRead)) {
                    $name = $holder->lastName . " " . $holder->firstName;
                    $type = $holder->type === ProfileType_Instructor ? "Giảng viên"
                            : ($holder->type === ProfileType_Instructor ? "Học viên"
                            : "Không xác định");
                }
            }
            ?>
            <p class="name"><?= $name ?></p>
            <p class="type"><?= $type ?><input type="button" value="Đăng xuất"></p>
        </card>
        <?
    }

    public function signedOutHeader() {
        ?>
        <card class="header">
            <p class="title">Thông tin cá nhân</p>
            <input class="outlined" type="button" value="Đăng ký">
            <input type="button" value="Đăng nhập">
        </card>
        <?
    }

    public function editProfile() {
        $holder = $this->holder;
        $key = $holder->getKey();
        $updateProfile = $key->isPermissionGranted(Permission_ProfileUpdate);
        $updateAccount = $key->isPermissionGranted(Permission_AccountUpdate);
        if (!$updateProfile && !$updateAccount) return;
        $readProfile = $key->isPermissionGranted(Permission_ProfileRead);
        $readAccount = $key->isPermissionGranted(Permission_AccountRead);
        ?>
        <form class="modal" action="/profile/update.php" method="post">
            <card class="section">
                <p class="title">Sửa thông tin hồ sơ</p>
                <?
                $profile = null;
                $account = null;
                if ($holder instanceof Account)
                {
                    $profile = null;
                    $account = $holder;
                }
                elseif ($holder instanceof Profile)
                {
                    $profile = $holder;
                    $account = $profile->getAccount();
                }
                if (isset($profile))
                {
                    ?>
                    <label for="ilname">Họ</label>
                    <input id="ilname" name="lName" placeholder="Họ" required type="text" value="<?= $readProfile ? $profile->lastName : "" ?>">
                    <label for="ifname">Tên</label>
                    <input id="ifname" name="fName" placeholder="Tên" required type="text" value="<?= $readProfile ? $profile->firstName : "" ?>">
                    <label for="sgender">Giới tính</label>
                    <select id="sgender" name="gender" required>
                        <?
                        $selected = " selected";
                        $maleSelected = "";
                        $femaleSelected = "";
                        if ($readProfile) {
                            if ($profile->gender === Gender_Male)
                                $maleSelected = $selected;
                            else $femaleSelected = $selected;
                        }
                        ?>
                        <option value="<?= Gender_Male ?>"<?= $maleSelected ?>>Nam</option>
                        <option value="<?= Gender_Female ?>"<?= $femaleSelected ?>>Nữ</option>
                    </select>
                    <label for="ibirthday">Ngày sinh</label>
                    <input id="ibirthday" name="birthday" required type="date" value="<?= $readProfile ? $profile->birthday : "2000-01-01" ?>">
                    <?
                }
                if (isset($account))
                {
                    ?>
                    <label for="iuname">Tên người dùng</label>
                    <input id="iuname" name="uName" placeholder="Tên người dùng" required type="text" value="<?= $readAccount ? $account->userName : "" ?>">
                    <?
                }
                ?>
                <input id="iexit" type="reset" value="Thoát">
                <input type="submit" value="Cập nhật">
            </card>
        </form>
        <?
    }

    public function changePassword() {
        $holder = $this->holder;
        $key = $holder->getKey();
        $updateAccount = $key->isPermissionGranted(Permission_AccountUpdate);
        if (!$updateAccount) return;
        ?>
        <form class="modal" action="/profile/update-password.php" method="post">
            <card class="section">
                <p class="title">Đổi mật khẩu</p>
                <label for="ipassword">Mật khẩu hiện tại</label>
                <input id="ipassword" name="password" placeholder="Mật khẩu hiện tại" type="password">
                <label for="ixpassword">Mật khẩu mới</label>
                <input id="ixpassword" name="xpassword" placeholder="Mật khẩu mới" type="password">
                <label for="izpassword">Nhập lại mật khẩu mới</label>
                <input id="izpassword" name="zpassword" placeholder="Nhập lại mật khẩu mới" type="password">
                <input id="iexit" type="reset" value="Thoát">
                <input type="submit" value="Cập nhật">
            </card>
        </form>
        <?
    }

    public function body()
    {
        if (isset($this->holder))
            $this->signedInHeader();
        else
            $this->signedOutHeader();

        $holder = $this->holder;
        $key = $holder->getKey();
        $profile = null;
        $account = null;
        if ($holder instanceof Account)
        {
            $profile = null;
            $account = $holder;
        }
        elseif ($holder instanceof Profile)
        {
            $profile = $holder;
            $account = $profile->getAccount();
        }
        if (isset($holder)) {
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
            $hasRelatedActions = $hasUndefindActions && $hasCourseSupscriptionHistory && $hasAdministrationAction;
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
            // TODO: 
            if (isset($profile)) {
                ?>
                <card class="section verification">
                    <div class="list-heading" title="Thông tin xác thực">
                        <p class="icon mdi-b"></p>
                        <a class="add action mdi-b" href="#">Thêm</a>
                    </div>
                    <hr>
                    <a class="list-item phone" href="#" heading="Điện thoại" title="0987654321">
                        <p class="icon mdi-b"></p>
                        <p class="action mdi-b"></p>
                    </a>
                    <hr>
                    <a class="list-item phone" href="#" heading="Điện thoại" title="0123456789">
                        <p class="icon mdi-b"></p>
                        <p class="action mdi-b"></p>
                    </a>
                    <hr>
                    <a class="list-item email" href="#" heading="Email" title="some.one.123@example.com">
                        <p class="icon mdi-b"></p>
                        <p class="action mdi-b"></p>
                    </a>
                    <hr>
                    <a class="list-item email" href="#" heading="Email" title="someone.123@example.com">
                        <p class="icon mdi-b"></p>
                        <p class="action mdi-b"></p>
                    </a>
                    <hr>
                    <a class="list-item email" href="#" heading="Email" title="xxxxxxxxxxxxxxxxsomeone123@example.com">
                        <p class="icon mdi-b"></p>
                        <p class="action mdi-b"></p>
                    </a>
                </card>
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
    public function modal() {
        if ($this->mode === ProfilePageMode_UpdateProfile)
            $this->editProfile();
        if ($this->mode === ProfilePageMode_ChangePassword)
            $this->changePassword();
    }
    // public function afterDocument()
    // {
    //     parent::afterDocument();
    // }
}
?>