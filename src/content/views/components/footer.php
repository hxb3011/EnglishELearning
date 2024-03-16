<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="../../public/css/footer/footer.css">
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="d-flex">
                    <a class="navbar-brand header__navbar-brand" href="#">
                        <img src="../../public/images/icon.png" class="header__navbar-logo" alt="Logo">
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
    </div>
    <!-- Back to Top -->
    <button id="back-to-top" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></button>
</footer>
<script>
    let backToTop = document.getElementById('back-to-top');
    window.onscroll = function() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            backToTop.style.display = 'block';
        } else {
            backToTop.style.display = 'none';
        }
    }
    backToTop.onclick = function() {
        document.body.scrollTop = 0; // For Safari
        document.documentElement.scrollTop = 0; // For Chrome
    }
</script>