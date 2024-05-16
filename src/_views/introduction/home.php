<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("utils/htmlDocument.php");

final class CoursesIntroductionHomePage extends BaseHTMLDocumentPage
{
    public array $courses = array();
    public $basePath;
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
            "/clients/css/introduction/home.css"
        );
        $this->scripts(
            "https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js",
            "https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js",
            "https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js",
            "https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js",
            "/clients/utils/backToTop.js"
        );
    }
    public function body()
    {
        ?>
        <card class="banner">
            <!-- <img src="/assets/images/banner-main.png" alt="Băng rôn"> -->
            <h1>Phát triển hoàn thiện kỹ năng với khóa học online</h1>
            <p>Chúng tôi luôn luôn lắng nghe nhu cầu của bạn và tận tâm phục vụ</p>
            <a href="/courses/all.php">Tham gia học ngay</a>
        </card>

        <card class="courses section">
            <div class="heading" title="Khóa học nổi bật" sub-title="Khám phá các khóa học nổi bật của chúng tôi">
                <a href="/courses/all.php">Tất cả khóa học</a>
            </div>
            <div class="content d-flex justify-content-between">
                <? foreach ($this->courses as $key => $course) : ?>
                    <a href="/courses/detail.php?courseId=<? echo $course->id ?>">
                        <img class="banner" src="<?echo($this->basePath.$course->posterURI)?>" alt="">
                        <p class="name" instructor="by <? echo $course->tutorName; ?>"><? echo $course->name; ?></p>
                        <div class="data">
                            <span class="mdi-b calendar">
                                <?
                                    $interval = $course->beginDate->diff($course->endDate);
                                    echo ($interval->days . ' Ngày');
                                ?>
                            </span>
                            <span class="mdi-b graduation"><? echo $course->totalStudent; ?> Học viên</span>
                        </div>
                        <p class="footer" href="/courses/detail.php?courseId=<? echo $course->id ?>" price="300.000 VNĐ">Xem chi tiết</p>
                    </a>
                <? endforeach ?>
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
                <div class="mdi-b item">
                    <p class="feedback">Trang web đã giúp tôi học được Tiếng Anh, trước đấy 1 chữ tôi cũng không biết, bây giờ đã có thể nói chuyện được với người Mỹ (Mỹ Tho)</p>
                    <p class="owner" role="Học viên">Lê Tấn Minh Toàn</p>
                </div>
                <div class="mdi-b item">
                    <p class="feedback">Tôi mới sử dụng web này thôi nhưng thấy web rất là xịn xò, có cả phân trang, thống kê, ajax, web này xứng đáng điểm cao</p>
                    <p class="owner" role="Học viên">Lê Tấn Minh Toàn</p>
                </div>
                <div class="mdi-b item">
                    <p class="feedback">Tôi rất bực, tôi chưa bao giờ thấy web nào xịn như web này, thật không thể chấp nhận được. Tôi mà là giáo viên chấm web này phải được cộng điểm</p>
                    <p class="owner" role="Học viên">Lê Tấn Minh Toàn</p>
                </div>
                <div class="mdi-b item">
                    <p class="feedback">Các bạn đừng vào web này nhè, tốn thời gian lắm. Vì từ hồi vào đây tôi không thể ngừng học tiếng Anh được, đến nỗi không có thời gian để làm việc khác, web quá xịn</p>
                    <p class="owner" role="Học viên">Lê Tấn Minh Toàn</p>
                </div>
                <div class="mdi-b item">
                    <p class="feedback">Học tiếng Anh chưa bao giờ dễ đến vậy, trang web này có mọi thứ mình cần luôn, có cả từ điển xịn xò, các bạn mau đăng ký đi. (Comment này ko có seeding đâu)</p>
                    <p class="owner" role="Học viên">Lê Tấn Minh Toàn</p>
                </div>
                <div class="mdi-b item">
                    <p class="feedback">Tôi là Elon Musk, có tôi đã sử dụng web này 10 năm nay và thấy nó rất tốt. Các bạn nên dùng nó đi</p>
                    <p class="owner" role="Học viên">Lê Tấn Minh Toàn</p>
                </div>
            </div>
        </card>
        <card class="blog section">
            <div class="heading" title="Bài viết mới nhất" sub-title="Các chia sẻ từ học viên, giảng viên ....">
                <a href="/blog/all.php">Tất cả bài viết</a>
            </div>
            <div class="content">
                <div class="item">
                    <img class="banner" src="/assets/images/banner-2.png" alt="">
                    <p class="title">Vì sao tôi lựa chọn EduPress ?</p>
                    <p class="mdi-b calendar">25 / 05 / 2023</p>
                    <p class="detail">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
                <div class="item">
                    <img class="banner" src="/assets/images/banner-2.png" alt="">
                    <p class="title">Vì sao tôi lựa chọn EduPress ?</p>
                    <p class="mdi-b calendar">25 / 05 / 2023</p>
                    <p class="detail">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
                <div class="item">
                    <img class="banner" src="/assets/images/banner-2.png" alt="">
                    <p class="title">Vì sao tôi lựa chọn EduPress ?</p>
                    <p class="mdi-b calendar">25 / 05 / 2023</p>
                    <p class="detail">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
                <div class="item">
                    <img class="banner" src="/assets/images/banner-2.png" alt="">
                    <p class="title">Vì sao tôi lựa chọn EduPress ?</p>
                    <p class="mdi-b calendar">25 / 05 / 2023</p>
                    <p class="detail">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
                <div class="item">
                    <img class="banner" src="/assets/images/banner-2.png" alt="">
                    <p class="title">Vì sao tôi lựa chọn EduPress ?</p>
                    <p class="mdi-b calendar">25 / 05 / 2023</p>
                    <p class="detail">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
                <div class="item">
                    <img class="banner" src="/assets/images/banner-2.png" alt="">
                    <p class="title">Vì sao tôi lựa chọn EduPress ?</p>
                    <p class="mdi-b calendar">25 / 05 / 2023</p>
                    <p class="detail">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
                <div class="item">
                    <img class="banner" src="/assets/images/banner-2.png" alt="">
                    <p class="title">Vì sao tôi lựa chọn EduPress ?</p>
                    <p class="mdi-b calendar">25 / 05 / 2023</p>
                    <p class="detail">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
            </div>
        </card>
        <card class="footer" copyright="Copyright © 2024 LMS | Powered by TeamDev">
            <div class="greeting">
                <a href="/index.php">ELearning</a>
                Chào mừng đến với trang web học tiếng Anh trực tuyến! Chúng tôi cung cấp một nền tảng học tập linh hoạt và tiện lợi cho mọi người muốn nâng cao kỹ năng tiếng Anh của mình. Với hàng trăm bài học, bài kiểm tra, và tài nguyên học liệu đa dạng, chúng tôi cam kết mang đến trải nghiệm học tập tích cực và hiệu quả nhất cho bạn.
            </div>
            <div class="group" label="Cần trợ giúp ?">
                <a href="/introduction/contact.php">Liên hệ</a>
                <a href="/blog/all.php">Bài viết mới</a>
                <a href="/introduction/faqs.php">FAQ</a>
            </div>
            <div class="group" label="Khóa học">
                <a href="/courses/all.php">Các khóa học</a>
            </div>
            <div class="contact group" label="Liên hệ">
                <p class="mdi-b addr">Address: 273 Đ. An Dương Vương, Phường 3, Quận 5, Thành phố Hồ Chí Minh</p>
                <p class="mdi-b tel">Tel:+ (123) 2500-567-8988</p>
                <p class="mdi-b mob">Phone:+ (123) 2500-567-8988</p>
            </div>
        </card>
        <!-- Back to Top -->
        <button id="to-top-button" title="Go To Top" class="z-90 bottom-8 right-8 border-0 w-10 h-10 rounded-full drop-shadow-md text-white text-lg font-bold">↑</button>
        <?
    }

    // public function afterDocument()
    // {
    //     parent::afterDocument();
    // }
}
?>