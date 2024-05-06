<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("utils/htmlDocument.php");

final class ProfileMainPage extends BaseHTMLDocumentPage
{
    public function __construct()
    {
        parent::__construct();
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
        // $this->scripts(

        // );
    }

    public function signedInHeader() {
        ?>
        <card class="header signed">
            <img class="prof-pic" src="/assets/images/banner-2.png" alt="Ảnh hồ sơ">
            <p class="mdi-b alt-prof-pic"></p>
            <p class="name">Nguyễn Nguyễn Nguyễn Nguyễn Nguyễn</p>
            <p class="type">Học viên<input type="button" value="Đăng xuất"></p>
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

    public function body()
    {
        $this->signedOutHeader();
        ?>
        <card class="section profile">
            <div class="list-heading" title="Thông tin hồ sơ">
                <p class="icon mdi-b"></p>
                <a class="edit action mdi-b" href="#">Sửa</a>
            </div>
            <hr>
            <a class="list-item gender" href="#" heading="Giới tính" title="Nam">
                <p class="icon mdi-b"></p>
                <p class="action mdi-b"></p>
            </a>
            <hr>
            <a class="list-item birthday" href="#" heading="Ngày sinh" title="01/01/2000">
                <p class="icon mdi-b"></p>
                <p class="action mdi-b"></p>
            </a>
            <hr>
            <a class="list-item username" href="#" heading="Tên người dùng" title="user0">
                <p class="icon mdi-b"></p>
                <p class="action mdi-b"></p>
            </a>
            <hr>
            <a class="list-item password" href="#" heading="Mật khẩu" title="Đổi mật khẩu">
                <p class="icon mdi-b"></p>
                <p class="action mdi-b"></p>
            </a>
        </card>
        <card class="section related">
            <div class="list-heading" title="Liên kết liên quan">
                <p class="icon mdi-b"></p>
            </div>
            <hr>
            <a class="list-item gender" href="#" heading="Scope" title="Action">
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
            <a class="list-item history" href="#" heading="Khoá học" title="Lịch sử đăng ký">
                <p class="icon mdi-b"></p>
                <p class="action mdi-b"></p>
            </a>
            <hr>
            <a class="list-item administration" href="#" heading="Hệ thống" title="Quản trị hệ thống">
                <p class="icon mdi-b"></p>
                <p class="action mdi-b"></p>
            </a>
        </card>
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
        <card class="section settings">
            <div class="list-heading" title="Cài đặt">
                <p class="icon mdi-b"></p>
                <a class="edit action mdi-b" href="#">Sửa</a>
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
        <!-- <card class="section" style="font-size: 32rem;">
            <p class="title">profile(firstName, lastName, gender, birthday, type, status, uid, role)</p>
            <p class="title">account(username, password, perms, status)</p>
            <p class="title">role(name, perms)</p>
            <p class="title">verification(profid, key)</p>
            <p class="title">payment(id, key, profid)</p>
        </card> -->
        <?
    }
    // public function afterDocument()
    // {
    //     parent::afterDocument();
    // }
}
?>