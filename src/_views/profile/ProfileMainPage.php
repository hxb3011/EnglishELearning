<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("utils/htmlDocument.php");
requirm("profile/profile.php");

final class ProfileMainPage extends BaseHTMLDocumentPage
{
    private ?IPermissionHolder $holder;
    private array $verifications;
    public function __construct(?IPermissionHolder $holder, array $verifications)
    {
        parent::__construct(NAV_PROF);
        $this->holder = $holder;
        $this->verifications = $verifications;
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
        $this->scripts(
            "/clients/profile/main.js"
        );
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
                        <a class="list-item administration" href="/administration/index.php" heading="Hệ thống" title="Quản trị hệ thống">
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
                // TODO: payments
                //   <card class="section payments">
                //     <div class="list-heading" title="Phương thức thanh toán">
                //         <p class="icon mdi-b"></p>
                //         <a class="add action mdi-b" href="#">Thêm</a>
                //     </div>
                //     <hr>
                //     <a class="list-item wallet" href="#" heading="Mobile Money" title="0xxxxx1234">
                //         <p class="icon mdi-b"></p>
                //         <p class="action mdi-b"></p>
                //     </a>
                //     <hr>
                //     <a class="list-item wallet" href="#" heading="Zalo Pay" title="0xxxxx1234">
                //         <p class="icon mdi-b"></p>
                //         <p class="action mdi-b"></p>
                //     </a>
                //     <hr>
                //     <a class="list-item card" href="#" heading="Visa" title="1234xxxx9012">
                //         <p class="icon mdi-b"></p>
                //         <p class="action mdi-b"></p>
                //     </a>
                //     <hr>
                //     <a class="list-item card" href="#" heading="Master Card" title="1234xxxx4321">
                //         <p class="icon mdi-b"></p>
                //         <p class="action mdi-b"></p>
                //     </a>
                //     <hr>
                //     <a class="list-item wallet" href="#" heading="VN Pay" title="1234xxxx1234">
                //         <p class="icon mdi-b"></p>
                //         <p class="action mdi-b"></p>
                //     </a>
                // </card>
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
    }
}
?>