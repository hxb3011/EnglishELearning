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
                                <iframe id="courseVideo" preload="auto" controlslist="nodownload" src="" class="learn__video"></iframe>
                                <button class="btn learn__video__btn-play" id="playBtn">
                                    <i class="mdi-b play"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <h2 style="font-size: 24rem; padding: 8rem;">Các bài giảng</h2>
                        <hr>
                        <div class="learn__lesson-list">
                            <div class="learn__lesson-item">
                                <div class="learn__lesson-item-inner">
                                    <div class="">
                                        <a class="learn_lesson-name " data-bs-toggle="collapse" href="#collapse1" role="button" aria-expanded="false" aria-controls="collapse1">
                                            Lesson
                                            <span class="mdi-b toggle"></span>
                                        </a>
                                    </div>
                                    <div class="collapse" id="collapse1" style="padding-left: 12rem; padding-right:12rem;">
                                        <div class="learn_lesson-doc">
                                            <div style="margin-right:8rem;">
                                                <input type="checkbox" id="checkbox" name="checkbox" value="checked" class="learn__lesson-item-status">
                                            </div>
                                            <div class="wrap" style="width:100%;padding-right:10rem; overflow:hidden;">
                                                <a href="" class="learn_lesson-doc_name">
                                                    <div class="text-wrapper">
                                                        hELLSDASDASDALSDHSJFHDKSFHDKSAJFHSKDAJFHDKSAJFHSAKFJHSADKFJHSADKFJDHSAFKSDHFJKASDFJ
                                                    </div>
                                                </a>
                                                <div class="mdi-b video"></div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="learn_lesson-doc">
                                            <div style="margin-right:8rem;">
                                                <input type="checkbox" id="checkbox" name="checkbox" value="checked" class="learn__lesson-item-status">
                                            </div>
                                            <div class="wrap" style="width:100%;padding-right:10rem; overflow:hidden;">
                                                <a href="" class="learn_lesson-doc_name">
                                                    <div class="text-wrapper">
                                                        hELLSDASDASDALSDHSJFHDKSFHDKSAJFHSKDAJFHDKSAJFHSAKFJHSADKFJHSADKFJDHSAFKSDHFJKASDFJ
                                                    </div>
                                                </a>
                                                <div class="mdi-b video"></div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="learn_lesson-doc">
                                            <div style="margin-right:8rem;">
                                                <input type="checkbox" id="checkbox" name="checkbox" value="checked" class="learn__lesson-item-status">
                                            </div>
                                            <div class="wrap" style="width:100%;padding-right:10rem; overflow:hidden;">
                                                <a href="" class="learn_lesson-doc_name">
                                                    <div class="text-wrapper">
                                                        hELLSDASDASDALSDHSJFHDKSFHDKSAJFHSKDAJFHDKSAJFHSAKFJHSADKFJHSADKFJDHSAFKSDHFJKASDFJ
                                                    </div>
                                                </a>
                                                <div class="mdi-b video"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="learn__lesson-item">
                                <div class="learn__lesson-item-inner">
                                    <div class="">
                                        <a class="learn_lesson-name " data-bs-toggle="collapse" href="#collapse1" role="button" aria-expanded="false" aria-controls="collapse1">
                                            Lesson
                                            <span class="mdi-b toggle"></span>
                                        </a>
                                    </div>
                                    <div class="collapse" id="collapse1" style="padding-left: 12rem; padding-right:12rem;">
                                        <div class="learn_lesson-doc">
                                            <div style="margin-right:8rem;">
                                                <input type="checkbox" id="checkbox" name="checkbox" value="checked" class="learn__lesson-item-status">
                                            </div>
                                            <div class="wrap" style="width:100%;padding-right:10rem; overflow:hidden;">
                                                <a href="" class="learn_lesson-doc_name">
                                                    <div class="text-wrapper">
                                                        hELLSDASDASDALSDHSJFHDKSFHDKSAJFHSKDAJFHDKSAJFHSAKFJHSADKFJHSADKFJDHSAFKSDHFJKASDFJ
                                                    </div>
                                                </a>
                                                <div class="mdi-b video"></div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="learn_lesson-doc">
                                            <div style="margin-right:8rem;">
                                                <input type="checkbox" id="checkbox" name="checkbox" value="checked" class="learn__lesson-item-status">
                                            </div>
                                            <div class="wrap" style="width:100%;padding-right:10rem; overflow:hidden;">
                                                <a href="" class="learn_lesson-doc_name">
                                                    <div class="text-wrapper">
                                                        hELLSDASDASDALSDHSJFHDKSFHDKSAJFHSKDAJFHDKSAJFHSAKFJHSADKFJHSADKFJDHSAFKSDHFJKASDFJ
                                                    </div>
                                                </a>
                                                <div class="mdi-b video"></div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="learn_lesson-doc">
                                            <div style="margin-right:8rem;">
                                                <input type="checkbox" id="checkbox" name="checkbox" value="checked" class="learn__lesson-item-status">
                                            </div>
                                            <div class="wrap" style="width:100%;padding-right:10rem; overflow:hidden;">
                                                <a href="" class="learn_lesson-doc_name">
                                                    <div class="text-wrapper">
                                                        hELLSDASDASDALSDHSJFHDKSFHDKSAJFHSKDAJFHDKSAJFHSAKFJHSADKFJHSADKFJDHSAFKSDHFJKASDFJ
                                                    </div>
                                                </a>
                                                <div class="mdi-b video"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?
        $this->scripts(
            "/node_modules/jquery/dist/jquery.min.js",
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