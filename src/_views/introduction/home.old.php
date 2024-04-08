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
            "/clients/css/home/home_main.css",
            "/clients/css/header/header.css",
            "/clients/css/footer/footer.css"
        );
        $this->scripts(
            "https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js",
            "https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js",
            "https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        );
    }

    public function body()
    {
        if(!isset($hideHeader))
        {
            ?>
            <div class="header ">
                <nav class="navbar navbar-expand-lg  header__navbar">
                    <div class="container">
                        <div class="header__navbar__brand-wrapper">
                            <a class="navbar-brand header__navbar-brand" href="/">
                                <img src="/assets/images/icon.png" class="header__navbar-logo" alt="Logo">
                                ELearning
                            </a>
                        </div>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse header__navbar-menu-wrapper" id="navbarSupportedContent">
                            <ul class="navbar-nav mb-2 mb-lg-0 header__navbar-menu">
                                <li class="nav-item header__navbar-menu__item active">
                                    <a class="nav-link " aria-current="page" href="/">Trang chủ</a>
                                </li>
                                <li class="nav-item header__navbar-menu__item">
                                    <a class="nav-link  " href="/courses/all">Khóa học</a>
                                </li>
                                <li class="nav-item header__navbar-menu__item">
                                    <a class="nav-link " href="/blog/all">Blog</a>
                                </li>
                                <li class="nav-item header__navbar-menu__item">
                                    <a class="nav-link " href="/home/faqs">FAQs</a>
                                </li>
                                <li class="nav-item header__navbar-menu__item">
                                    <a class="nav-link " href="/home/contact">Liên hệ</a>
                                </li>
                            </ul>
                            <div class="d-flex header__auth justify-content-end align-items-center ">
                                <a href="/authen/auth" class="header__auth-link">
                                    Login/Register
                                </a>
                            </div>
                        </div>
                    </div>
                </nav>

                <? 
                    $currentURI = $_SERVER['REQUEST_URI'];
                    $currentPage = explode('/', $currentURI);
                    foreach ($currentPage as $key => $value) {
                        if (strpos($value, '.php') !== false) {
                            $currentPage = explode('.', $value)[0];
                        }
                    }
                ?>
                <!-- Cập nhật lại sau-->
                <!-- <div class="navigation">
                    <div class="container">
                        <?
                            echo "<ul>";
                            echo "<li><a href='/content/views/home.php' class='nav-link'>Home </a></li>";
                            if ($currentPage != 'home'){
                                echo " > ";
                            }
                            if ($currentPage == 'bloglist'){
                                echo "<li><a href='/content/views/bloglist.php' class='nav-link'>Blog </a></li>";
                            }
                        ?>
                    </div>
                </div> -->
            </div>
            <?
        }
        ?>
        <div>
            <div class="banner" style="background-image: url('/assets/images/banner-main.png');">
                <div class="container banner-content">
                    <div>
                        <h1 class="banner-heading">
                            Phát triển hoàn thiện <br> kỹ năng với khóa học online
                        </h1>
                        <p class="banner-description">
                            Chúng tôi luôn luôn lắng nghe nhu cầu của bạn <br>
                            và tận tâm phục vụ
                        </p>
                        <a href="#" class="btn banner-btn">
                            Tham gia học ngay
                        </a>
                    </div>
                </div>
            </div>
            <div class="categories-section mt-5 pt-5 mb-5">
                <div class="container">
                    <div class="d-flex align-items-center justify-content-space-between">
                        <div class="me-auto">
                            <div class="section-heading">
                                Các danh mục
                            </div>
                            <div class="section-sub">
                                Khám phá các danh mục khóa học của chúng tôi
                            </div>
                        </div>
                        <a href="#" class="btn btn-view-all">Tất cả danh mục</a>
                    </div>

                    <div class="row mt-5">
                        <div class="col-md-3">
                            <div class="category-wrapper">
                                <img src="/assets/images/icon-paint.png" alt="" class="category-icon">
                                <div>
                                    <p class="category-name">
                                        Toeic
                                    </p>
                                    <p class="categoru-desc">38 Courses</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="category-wrapper">
                                <img src="/assets/images/icon-paint.png" alt="" class="category-icon">
                                <div>
                                    <p class="category-name">
                                        Toeic
                                    </p>
                                    <p class="categoru-desc">38 Courses</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="category-wrapper">
                                <img src="/assets/images/icon-paint.png" alt="" class="category-icon">
                                <div>
                                    <p class="category-name">
                                        Toeic
                                    </p>
                                    <p class="categoru-desc">38 Courses</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="category-wrapper">
                                <img src="/assets/images/icon-paint.png" alt="" class="category-icon">
                                <div>
                                    <p class="category-name">
                                        Toeic
                                    </p>
                                    <p class="categoru-desc">38 Courses</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="courses-section mt-5 pt-5 mb-5">
                <div class="container">
                    <div class="d-flex align-items-center justify-content-space-between">
                        <div class="me-auto">
                            <div class="section-heading">
                                Khóa học nổi bật
                            </div>
                            <div class="section-sub">
                                Khám phá các khóa học nổi bật của chúng tôi
                            </div>
                        </div>
                        <a href="#" class="btn btn-view-all">Tất cả khóa học</a>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-4">
                            <div class="course-wrapper card">
                                <a href="#" class="course-link">
                                    <img src="/assets/images/blog.png" alt="" class="card-top-img course__banner">
                                    <p class="course-instructor mt-2">by Hoàng Lâm</p>
                                    <div class="card-body">
                                        <h5 class="card-title course-name">
                                            Khóa học toeic 2 kỹ năng 450
                                        </h5>
                                        <div class="d-flex justify-content-start align-items-center mt-4">
                                            <div class="d-flex justify-content-center align-items-center">
                                                <img src="/assets/images/icon-calendar.png" class="course-info__icon me-2" alt="">
                                                <span class="course-info"> 2 Tuần </span>
                                            </div>
                                            <div class="d-flex justify-content-start align-items-center ms-3">
                                                <img src="/assets/images/icon-graduation.png" class="course-info__icon me-2">
                                                <span class="course-info "> 156 Học viên </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer mt-2">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <p class="course-price">300.000 VNĐ</p>
                                            <a href="#" class="course-view-detail">Xem chi tiết</a>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="course-wrapper card">
                                <a href="#" class="course-link">
                                    <img src="/assets/images/blog.png" alt="" class="card-top-img course__banner">
                                    <p class="course-instructor mt-2">by Hoàng Lâm</p>
                                    <div class="card-body">
                                        <h5 class="card-title course-name">
                                            Khóa học toeic 2 kỹ năng 450
                                        </h5>
                                        <div class="d-flex justify-content-start align-items-center mt-4">
                                            <div class="d-flex justify-content-center align-items-center">
                                                <img src="/assets/images/icon-calendar.png" class="course-info__icon me-2" alt="">
                                                <span class="course-info"> 2 Tuần </span>
                                            </div>
                                            <div class="d-flex justify-content-start align-items-center ms-3">
                                                <img src="/assets/images/icon-graduation.png" class="course-info__icon me-2">
                                                <span class="course-info "> 156 Học viên </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer mt-2">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <p class="course-price">300.000 VNĐ</p>
                                            <a href="#" class="course-view-detail">Xem chi tiết</a>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="course-wrapper card">
                                <a href="#" class="course-link">
                                    <img src="/assets/images/blog.png" alt="" class="card-top-img course__banner">
                                    <p class="course-instructor mt-2">by Hoàng Lâm</p>
                                    <div class="card-body">
                                        <h5 class="card-title course-name">
                                            Khóa học toeic 2 kỹ năng 450
                                        </h5>
                                        <div class="d-flex justify-content-start align-items-center mt-4">
                                            <div class="d-flex justify-content-center align-items-center">
                                                <img src="/assets/images/icon-calendar.png" class="course-info__icon me-2" alt="">
                                                <span class="course-info"> 2 Tuần </span>
                                            </div>
                                            <div class="d-flex justify-content-start align-items-center ms-3">
                                                <img src="/assets/images/icon-graduation.png" class="course-info__icon me-2">
                                                <span class="course-info "> 156 Học viên </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer mt-2">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <p class="course-price">300.000 VNĐ</p>
                                            <a href="#" class="course-view-detail">Xem chi tiết</a>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="info-section mt-5 pt-5 mb-5">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="info">
                                <p class="info__number">120</p>
                                <p class="info__name">học viên</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info">
                                <p class="info__number">5</p>
                                <p class="info__name">Khóa học</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info">
                                <p class="info__number">6</p>
                                <p class="info__name">Giảng Viên</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info">
                                <p class="info__number">100%</p>
                                <p class="info__name">Hài lòng</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="feedback-section mt-5 pt-5 mb-5">
                <div class="container">
                    <div class="d-flex align-items-center justify-content-center">
                        <div class="">
                            <div class="section-heading text-center">
                                Đánh giá
                            </div>
                            <div class="section-sub  text-center">
                                Những gì học viên nói về EduPress
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-3">
                            <div class="card feedback-wrapper">
                                <img src="/assets/images/icon-blog.png" class="feedback-icon" alt="">
                                <p class="feedback-content" align="jusitify">Tôi phải giải thích cho bạn biết tại sao tất cả điều này lại sai lầm. Tdea tố cáo niềm vui và ca ngợi nỗi đau đã ra đời và tôi sẽ cung cấp cho bạn một tài khoản đầy đủ về hệ thống và giải thích</p>
                                <h3 class="card-title feedback-own">Lê Tấn Minh Toàn</h3>
                                <p class="card-text feedback-own_role">Học viên</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card feedback-wrapper">
                                <img src="/assets/images/icon-blog.png" class="feedback-icon" alt="">
                                <p class="feedback-content" align="jusitify">Tôi phải giải thích cho bạn biết tại sao tất cả điều này lại sai lầm. Tdea tố cáo niềm vui và ca ngợi nỗi đau đã ra đời và tôi sẽ cung cấp cho bạn một tài khoản đầy đủ về hệ thống và giải thích</p>
                                <h3 class="card-title feedback-own">Lê Tấn Minh Toàn</h3>
                                <p class="card-text feedback-own_role">Học viên</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card feedback-wrapper">
                                <img src="/assets/images/icon-blog.png" class="feedback-icon" alt="">
                                <p class="feedback-content" align="jusitify">Tôi phải giải thích cho bạn biết tại sao tất cả điều này lại sai lầm. Tdea tố cáo niềm vui và ca ngợi nỗi đau đã ra đời và tôi sẽ cung cấp cho bạn một tài khoản đầy đủ về hệ thống và giải thích</p>
                                <h3 class="card-title feedback-own">Lê Tấn Minh Toàn</h3>
                                <p class="card-text feedback-own_role">Học viên</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card feedback-wrapper">
                                <img src="/assets/images/icon-blog.png" class="feedback-icon" alt="">
                                <p class="feedback-content" align="jusitify">Tôi phải giải thích cho bạn biết tại sao tất cả điều này lại sai lầm. Tdea tố cáo niềm vui và ca ngợi nỗi đau đã ra đời và tôi sẽ cung cấp cho bạn một tài khoản đầy đủ về hệ thống và giải thích</p>
                                <h3 class="card-title feedback-own">Lê Tấn Minh Toàn</h3>
                                <p class="card-text feedback-own_role">Học viên</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="blog-section mt-5 pt-5 mb-5">
                <div class="container">
                    <div class="d-flex align-items-center justify-content-space-between">
                        <div class="me-auto">
                            <div class="section-heading">
                                Bài viết mới nhất
                            </div>
                            <div class="section-sub">
                                Các chia sẻ từ học viên, giảng viên ....
                            </div>
                        </div>
                        <a href="#" class="btn btn-view-all">Tất cả bài viết</a>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-4">
                            <div class="card blog-wrapper">
                                <img src="/assets/images/banner-2.png" alt="" class="blog-image card-top-image">
                                <div class="card-body">
                                    <h3 class="card-title blog-title">
                                        Vì sao tôi lựa chọn EduPress ?
                                    </h3>
                                    <div class="d-flex justify-content-start align-items-center">
                                        <img src="/assets/images/icon-calendar.png" class="calendar" alt="">
                                        <p class="blogdate">25 / 05 / 2023</p>
                                    </div>

                                    <div class="card-text">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card blog-wrapper">
                                <img src="/assets/images/banner-2.png" alt="" class="blog-image card-top-image">
                                <div class="card-body">
                                    <h3 class="card-title blog-title">
                                        Vì sao tôi lựa chọn EduPress ?
                                    </h3>
                                    <div class="d-flex justify-content-start align-items-center">
                                        <img src="/assets/images/icon-calendar.png" class="calendar" alt="">
                                        <p class="blogdate">25 / 05 / 2023</p>
                                    </div>

                                    <div class="card-text">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card blog-wrapper">
                                <img src="/assets/images/banner-2.png" alt="" class="blog-image card-top-image">
                                <div class="card-body">
                                    <h3 class="card-title blog-title">
                                        Vì sao tôi lựa chọn EduPress ?
                                    </h3>
                                    <div class="d-flex justify-content-start align-items-center">
                                        <img src="/assets/images/icon-calendar.png" class="calendar" alt="">
                                        <p class="blogdate">25 / 05 / 2023</p>
                                    </div>

                                    <div class="card-text">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="d-flex">
                            <a class="navbar-brand header__navbar-brand" href="#">
                                <img src="/assets/images/icon.png" class="header__navbar-logo" alt="Logo">
                                ELearning
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3 d-flex justify-content-center align-items-center">
                        <div class="footer-heading ">
                            Cần trợ giúp ?
                        </div>
                    </div>
                    <div class="col-md-3 d-flex justify-content-center align-items-center">
                        <div class="footer-heading ">
                            Khóa học
                        </div>
                    </div>
                    <div class="col-md-3 d-flex justify-content-center align-items-center">
                        <div class="footer-heading ">
                            Liên hệ
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <p class="footer_greeting ">
                            Chào mừng đến với trang web học tiếng Anh trực tuyến! Chúng tôi cung cấp một nền tảng học tập linh hoạt và tiện lợi cho mọi người muốn nâng cao kỹ năng tiếng Anh của mình. Với hàng trăm bài học, bài kiểm tra, và tài nguyên học liệu đa dạng, chúng tôi cam kết mang đến trải nghiệm học tập tích cực và hiệu quả nhất cho bạn."
                        </p>
                    </div>
                    <div class="col-md-3 d-flex justify-content-center">
                        <ul class="footer__list">
                            <li class="footer__list-item">
                                <a href="#" class="footer__list-item__link">
                                    Liên hệ
                                </a>
                            </li>
                            <li class="footer__list-item">
                                <a href="#" class="footer__list-item__link">
                                    Bài viết mới
                                </a>
                            </li>
                            <li class="footer__list-item">
                                <a href="#" class="footer__list-item__link">
                                    FAQ
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-3 d-flex justify-content-center">
                        <ul class="footer__list">
                            <li class="footer__list-item">
                                <a href="#" class="footer__list-item__link">
                                    Các khóa học
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <p class="footer_text">Address: 273 Đ. An Dương Vương, Phường 3, Quận 5, Thành phố Hồ Chí Minh</p>
                        <p class="footer_text"><img src="" class="footer-icon" alt="">Tel:+ (123) 2500-567-8988</p>
                        <p class="footer_text"><img src="" class="footer-icon" alt="">Phone:+ (123) 2500-567-8988</p>

                    </div>
                </div>
                <hr>
                <span class="copyright d-flex justify-content-center">Copyright © 2024 LMS | Powered by TeamDev</span>
            </div>
            <!-- Back to Top -->
            <button id="back-to-top" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></button>
        </footer>
        <script src="/clients/utils/backToTop.js"></script>
        <?
    }

    // public function afterDocument()
    // {
    //     parent::afterDocument();
    // }
}
?>