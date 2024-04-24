<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("utils/htmlDocument.php");

final class LearnPage extends BaseHTMLDocumentPage
{
    public $hideNav = true;
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
            "/node_modules/bootstrap/dist/css/bootstrap.min.css",
            "/clients/css/courses/learn.css",
        );
        $this->scripts(
            "/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js",
        );
    }

    public function body()
    {
?>
        <div class="wrapper">
            <div class="learn__header">
                <div class="learn__header-inner">
                    <div class="d-flex learn__header-logo-wrapper">
                        <a class="navbar-brand header__navbar-brand" href="/">
                            <img src="/assets/images/icon.png" class="learn__header-logo" alt="Logo">
                            ELearning
                        </a>
                    </div>
                    <div class="learn__header-title-wrapper">
                        <a class="learn__header-title" href="#">Create Web app with Angular 12,.NET CORE WEB API & MySQL</a>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8 col-sm-12">
                        <div id="course_content">
                            <div class="learn__video-wrapper">
                                <video id="courseVideo" preload="auto" controlslist="nodownload" src="https://www.youtube.com/watch?v=hue-IgXuU_4&list=RDhue-IgXuU_4&start_radio=1" class="learn__video"></video>
                                <button class="btn learn__video__btn-play" id="playBtn">
                                    <i class="mdi -play"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <h2 style="font-size: 12rem; padding: 4rem;">Các bài giảng</h2>
                        <hr>
                        <ul class="learn__lesson-list">
                            <li class="learn__lesson-item">
                                <div class="learn__lesson-item-inner">
                                    <div style="margin-right:4rem;">
                                        <input type="checkbox" id="checkbox" name="checkbox" value="checked" class="learn__lesson-item-status">
                                    </div>
                                    <div class="flex-grow-1 ps-4">
                                        <div class="learn__lesson-item__title">
                                            <a href="#">
                                                Install Visual Studio
                                            </a>
                                        </div>
                                        <div class="learn__lesson-item__more-info d-flex align-items-center">
                                            <div class="learn__lesson-item__type d-flex align-items-center pt-2">
                                                <i class="mdi -quiz"></i>
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
                                    <div style="margin-right:4rem;">
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
                                                <i class="mdi -document"></i>
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
                                    <div style="margin-right:4rem;">
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
                                                <i class="mdi -video"></i>
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
        </div>
        <?
        $this->scripts(
            "/node_modules/jquery/dist/jquery.min.js",
            "/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js",
        );
        ?>
<?

    }

    // public function afterDocument()
    // {
    //     parent::afterDocument();
    // }
}
?>