<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("utils/htmlDocument.php");

final class CoursesIntroductionHomePage extends BaseHTMLDocumentPage
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
        parent::documentInfo($author, $description, "Hệ thống E-learning");
    }

    public function openGraphInfo(string $image, string $description, string $title)
    {
        parent::openGraphInfo($image, $description, "Hệ thống E-learning");
    }

    public function favIcon(string $ico = null, string $svg = null)
    {
        parent::favIcon("/assets/images/logo-icon.png", null);
    }

    public function head()
    {
        $this->style(
            "https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css",
            "sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
        );
        $this->script(
            "https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js",
            "sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        );
        $this->styles(
            "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css",
            "/clients/css/layout/card.css",
            "/clients/css/header/header.main.css",
            "/clients/css/footer/footer.main.css",
            "/clients/css/home/home.main.css"
        );
        $this->scripts(
            "https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js",
            "https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js",
            "https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        );
    }

    public function body()
    {
        ?>
        <card class="banner">
            <!-- <img src="/assets/images/banner-main.png" alt="Băng rôn"> -->
            <h1>Phát triển hoàn thiện kỹ năng với khóa học online</h1>
            <p>Chúng tôi luôn luôn lắng nghe nhu cầu của bạn và tận tâm phục vụ</p>
            <a href="#">Tham gia học ngay</a>
        </card>

        <card class="categories section">
            <div class="heading" title="Các danh mục" sub-title="Khám phá các danh mục khóa học của chúng tôi">
                <a href="#">Tất cả danh mục</a>
            </div>
            <div class="content">
                <div class="item" description="38 Courses" name="Toeic">
                    <img src="/assets/images/icon-paint.png" alt="">
                </div>
                <div class="item" description="38 Courses" name="Toeic">
                    <img src="/assets/images/icon-paint.png" alt="">
                </div>
                <div class="item" description="38 Courses" name="Toeic">
                    <img src="/assets/images/icon-paint.png" alt="">
                </div>
                <div class="item" description="38 Courses" name="Toeic">
                    <img src="/assets/images/icon-paint.png" alt="">
                </div>
                <div class="item" description="38 Courses" name="Toeic">
                    <img src="/assets/images/icon-paint.png" alt="">
                </div>
                <div class="item" description="38 Courses" name="Toeic">
                    <img src="/assets/images/icon-paint.png" alt="">
                </div>
                <div class="item" description="38 Courses" name="Toeic">
                    <img src="/assets/images/icon-paint.png" alt="">
                </div>
                <div class="item" description="38 Courses" name="Toeic">
                    <img src="/assets/images/icon-paint.png" alt="">
                </div>
                <div class="item" description="38 Courses" name="Toeic">
                    <img src="/assets/images/icon-paint.png" alt="">
                </div>
            </div>
        </card>
        <card class="courses section">
            <div class="heading" title="Khóa học nổi bật" sub-title="Khám phá các khóa học nổi bật của chúng tôi">
                <a href="#">Tất cả khóa học</a>
            </div>
            <div class="content">
                <a href="#">
                    <img class="banner" src="/assets/images/blog.png" alt="">
                    <p class="name" instructor="by Hoàng Lâm">Khóa học toeic 2 kỹ năng 450</p>
                    <div class="data">
                        <span class="mdi mdi-calendar calendar">2 Tuần</span>
                        <span class="mdi mdi-school graduation">156 Học viên</span>
                    </div>
                    <p class="footer" href="#" price="300.000 VNĐ">Xem chi tiết</p>
                </a>
                <a href="#">
                    <img class="banner" src="/assets/images/blog.png" alt="">
                    <p class="name" instructor="by Hoàng Lâm">Khóa học toeic 2 kỹ năng 450</p>
                    <div class="data">
                        <span class="mdi mdi-calendar">2 Tuần</span>
                        <span class="mdi mdi-school graduation">156 Học viên</span>
                    </div>
                    <p class="footer" href="#" price="300.000 VNĐ">Xem chi tiết</p>
                </a>
                <a href="#">
                    <img class="banner" src="/assets/images/blog.png" alt="">
                    <p class="name" instructor="by Hoàng Lâm">Khóa học toeic 2 kỹ năng 450</p>
                    <div class="data">
                        <span class="mdi mdi-calendar">2 Tuần</span>
                        <span class="mdi mdi-school graduation">156 Học viên</span>
                    </div>
                    <p class="footer" href="#" price="300.000 VNĐ">Xem chi tiết</p>
                </a>
            </div>
            <div class="statistic content">
                <p name="Học viên" value="120"></p>
                <p name="Khóa học" value="5"></p>
                <p name="Giảng Viên" value="6"></p>
                <p name="Hài lòng" value="100%"></p>
            </div>
        </card>
        <card class="feedback section">
            <div class="heading" title="Đánh giá" sub-title="Những gì học viên nói về EduPress"></div>
            <div class="content">
                <div class="mdi mdi-format-quote-close item">
                    <p class="feedback">Tôi phải giải thích cho bạn biết tại sao tất cả điều này lại sai lầm. Tdea tố cáo niềm vui và ca ngợi nỗi đau đã ra đời và tôi sẽ cung cấp cho bạn một tài khoản đầy đủ về hệ thống và giải thích</p>
                    <p class="owner" role="Học viên">Lê Tấn Minh Toàn</p>
                </div>
                <div class="mdi mdi-format-quote-close item">
                    <p class="feedback">Tôi phải giải thích cho bạn biết tại sao tất cả điều này lại sai lầm. Tdea tố cáo niềm vui và ca ngợi nỗi đau đã ra đời và tôi sẽ cung cấp cho bạn một tài khoản đầy đủ về hệ thống và giải thích</p>
                    <p class="owner" role="Học viên">Lê Tấn Minh Toàn</p>
                </div>
                <div class="mdi mdi-format-quote-close item">
                    <p class="feedback">Tôi phải giải thích cho bạn biết tại sao tất cả điều này lại sai lầm. Tdea tố cáo niềm vui và ca ngợi nỗi đau đã ra đời và tôi sẽ cung cấp cho bạn một tài khoản đầy đủ về hệ thống và giải thích</p>
                    <p class="owner" role="Học viên">Lê Tấn Minh Toàn</p>
                </div>
                <div class="mdi mdi-format-quote-close item">
                    <p class="feedback">Tôi phải giải thích cho bạn biết tại sao tất cả điều này lại sai lầm. Tdea tố cáo niềm vui và ca ngợi nỗi đau đã ra đời và tôi sẽ cung cấp cho bạn một tài khoản đầy đủ về hệ thống và giải thích</p>
                    <p class="owner" role="Học viên">Lê Tấn Minh Toàn</p>
                </div>
            </div>
        </card>
        <card class="blog section">
            <div class="heading" title="Bài viết mới nhất" sub-title="Các chia sẻ từ học viên, giảng viên ....">
                <a href="#">Tất cả bài viết</a>
            </div>
            <div class="content">
                <div class="item">
                    <img class="banner" src="/assets/images/banner-2.png" alt="">
                    <p class="title">Vì sao tôi lựa chọn EduPress ?</p>
                    <p class="mdi mdi-calendar">25 / 05 / 2023</p>
                    <p class="detail">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
                <div class="item">
                    <img class="banner" src="/assets/images/banner-2.png" alt="">
                    <p class="title">Vì sao tôi lựa chọn EduPress ?</p>
                    <p class="mdi mdi-calendar">25 / 05 / 2023</p>
                    <p class="detail">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
                <div class="item">
                    <img class="banner" src="/assets/images/banner-2.png" alt="">
                    <p class="title">Vì sao tôi lựa chọn EduPress ?</p>
                    <p class="mdi mdi-calendar">25 / 05 / 2023</p>
                    <p class="detail">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
            </div>
        </card>
        <card class="footer" copyright="Copyright © 2024 LMS | Powered by TeamDev">
            <div class="greeting">
                <a href="#">ELearning</a>
                Chào mừng đến với trang web học tiếng Anh trực tuyến! Chúng tôi cung cấp một nền tảng học tập linh hoạt và tiện lợi cho mọi người muốn nâng cao kỹ năng tiếng Anh của mình. Với hàng trăm bài học, bài kiểm tra, và tài nguyên học liệu đa dạng, chúng tôi cam kết mang đến trải nghiệm học tập tích cực và hiệu quả nhất cho bạn.
            </div>
            <div class="group" label="Cần trợ giúp ?">
                <a href="#">Liên hệ</a>
                <a href="#">Bài viết mới</a>
                <a href="#">FAQ</a>
            </div>
            <div class="group" label="Khóa học">
                <a href="#">Các khóa học</a>
            </div>
            <div class="contact group" label="Liên hệ">
                <p class="mdi mdi-office-building">Address: 273 Đ. An Dương Vương, Phường 3, Quận 5, Thành phố Hồ Chí Minh</p>
                <p class="mdi mdi-deskphone">Tel:+ (123) 2500-567-8988</p>
                <p class="mdi mdi-cellphone">Phone:+ (123) 2500-567-8988</p>
            </div>
        </card>
        <!-- Back to Top -->
        <button id="back-to-top" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></button>
        <script src="/clients/utils/backToTop.js"></script>
        <?
    }

    // public function afterDocument()
    // {
    //     parent::afterDocument();
    // }
}
?>