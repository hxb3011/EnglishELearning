<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("utils/htmlDocument.php");

final class LearnPage extends BaseHTMLDocumentPage
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
        parent::documentInfo($author, $description, "Tên khóa học - " . $title);
    }

    public function openGraphInfo(string $image, string $description, string $title)
    {
        parent::openGraphInfo($image, $description, "Tên khóa học - " . $title);
    }

    public function favIcon(string $ico = null, string $svg = null)
    {
        parent::favIcon($ico, $svg);
    }

    public function head()
    {
        $this->styles(
            "/clients/css/courses/learn.css"
        );
        // $this->scripts(

        // );
    }

    public function body()
    {
        ?>
        <div class="learn__header">
            <div class="learn__header-inner">
                <div class="d-flex learn__header-logo-wrapper">
                    <a class="navbar-brand header__navbar-brand" href="#">
                        <img src="/assets/images/icon.png" class="learn__header-logo" alt="Logo">
                        ELearning
                    </a>
                </div>
                <div class="learn__header-title-wrapper">
                    <a class="learn__header-title" href="#">Create Web app with Angular 12,.NET CORE WEB API & MySQL</a>
                </div>
                <div class="ms-4 d-flex align-items-center">
                    <div class="circle-progress">
                        <div class="circle-progress__outer">
                            <div class="circle-progress__inner">

                            </div>
                        </div>
                        <svg width="3.6rem" height="3.6rem" xmlns="http://www.w3.org/2000/svg" version="1.1">
                            <defs>
                                <linearGradient id="GradientColor">
                                    <stop offset="0%" stop-color="#ff782d" />
                                    <stop offset="100%" stop-color="#34eb46" />
                                </linearGradient>
                            </defs>
                            <circle cx="18" cy="18" r="16" stroke-linecap="round" />
                        </svg>
                    </div>
                    <div class="learn__header-title">
                        Tiến độ học tập
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 col-sm-12">
                    <div class="learn__video-wrapper">
                        <video id="courseVideo" preload="auto" controlslist="nodownload" src="https://www.youtube.com/watch?v=hue-IgXuU_4&list=RDhue-IgXuU_4&start_radio=1" class="learn__video"></video>
                        <button class="btn learn__video__btn-play" id="playBtn">
                            <i class="fa-solid fa-play"></i>
                        </button>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <h2 class="pt-4 pb-4">Các bài giảng</h2>
                    <hr>
                    <ul class="learn__lesson-list">
                        <li class="learn__lesson-item">
                            <div class="learn__lesson-item-inner">
                                <div>
                                    <input type="checkbox" id="checkbox" name="checkbox" value="checked" class="learn__lesson-item-status">
                                </div>
                                <div class="flex-grow-1 ps-4">
                                    <div class="learn__lesson-item__title">
                                        <a href="">
                                            Install Visual Studio
                                        </a>
                                    </div>
                                    <div class="learn__lesson-item__more-info d-flex align-items-center">
                                        <div class="learn__lesson-item__type d-flex align-items-center pt-2">
                                            <i class="fa-brands fa-youtube"></i>
                                        </div>
                                        <div class="learn__lesson-item__duration">
                                            5 phút
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <hr>
                        <li class="learn__lesson-item">
                            <div class="learn__lesson-item-inner">
                                <div>
                                    <input type="checkbox" id="checkbox" name="checkbox" value="checked" class="learn__lesson-item-status">
                                </div>
                                <div class="flex-grow-1 ps-4">
                                    <div class="learn__lesson-item__title">
                                        <a href="">
                                            Install Visual Studio
                                        </a>
                                    </div>
                                    <div class="learn__lesson-item__more-info d-flex align-items-center">
                                        <div class="learn__lesson-item__type d-flex align-items-center pt-2">
                                            <i class="fa-solid fa-paperclip"></i>
                                        </div>
                                        <div class="learn__lesson-item__duration">
                                            5 phút
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <hr>
                        <li class="learn__lesson-item">
                            <div class="learn__lesson-item-inner">
                                <div>
                                    <input type="checkbox" id="checkbox" name="checkbox" value="checked" class="learn__lesson-item-status">
                                </div>
                                <div class="flex-grow-1 ps-4">
                                    <div class="learn__lesson-item__title">
                                        <a href="">
                                            Install Visual Studio
                                        </a>
                                    </div>
                                    <div class="learn__lesson-item__more-info d-flex align-items-center">
                                        <div class="learn__lesson-item__type d-flex align-items-center pt-2">
                                            <i class="fa-solid fa-circle-question"></i>
                                        </div>
                                        <div class="learn__lesson-item__duration">
                                            5 phút
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <hr>
                    </ul>
                </div>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script>
            // Lấy phần tử hình tròn
            const circle = document.querySelector('circle');

            // Tính chu vi của hình tròn
            const radius = parseFloat(circle.getAttribute('r'));
            const circumference = 2 * Math.PI * radius;

            // Đặt giá trị dasharray ban đầu là chu vi của hình tròn
            circle.style.strokeDasharray = `${circumference}, ${circumference}`;
            circle.style.strokeDashoffset = `${circumference}`;

            function animateProgress(duration, progress) {
                const offset = circumference * (1 - progress);
                circle.style.transition = `stroke-dashoffset ${duration}ms ease`;
                circle.style.strokeDashoffset = offset;
            }
            animateProgress(500, 0.5);
            $("#playBtn").click(function() {
                var video = document.getElementById("courseVideo");
                if (video.paused) {
                    video.play();
                    $('#playBtn').hide()
                }

                $("#courseVideo").click(function() {
                    var video = document.getElementById("courseVideo");
                    if (!video.paused) {
                        video.pause()
                        $('#playBtn').show()
                    }

                })
            });
        </script>
        <?
    }

    // public function afterDocument()
    // {
    //     parent::afterDocument();
    // }
}
?>