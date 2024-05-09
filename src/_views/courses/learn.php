<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("utils/htmlDocument.php");

final class LearnPage extends BaseHTMLDocumentPage
{
    public $hideNav = true;
    public Course $course;
    public array $programs;
    public $currentProgram;
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
                        <a class="learn__header-title" href="#"><? echo $this->course->name ?></a>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8 col-sm-12">
                        <div id="course_content">
                            <!-- <div class="learn__video-wrapper" id="video-container">
                                <video id="courseVideo" preload="auto" src="" controls controlslist="nodownload" src="" class="learn__video"></video>
                            </div> -->
                            <div id="documentText-container">

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <h2 style="font-size: 24rem; padding: 8rem;">Các bài giảng</h2>
                        <hr>
                        <div class="learn__lesson-list">
                            <? foreach ($this->programs as $index => $program) : ?>
                                <? if ($program instanceof Lesson) : ?>
                                    <div class="learn__lesson-item">
                                        <div class="learn__lesson-item-inner">
                                            <div class="">
                                                <a class="learn_lesson-name " data-bs-toggle="collapse" href="#collapse<? echo $index + 1 ?>" role="button" aria-expanded="false" aria-controls="collapse1">
                                                    <? echo $program->Description ?>
                                                    <span class="mdi-b toggle"></span>
                                                </a>
                                            </div>
                                            <div class="collapse" id="collapse<? echo $index + 1 ?>"" style=" padding-left: 12rem; padding-right:12rem;">
                                                <? foreach ($program->Documents as $index => $document) : ?>
                                                    <div class="learn_lesson-doc">
                                                        <div style="margin-right:8rem;">
                                                            <input type="checkbox" name="checkbox" value="checked" class="learn__lesson-item-status" data-lesson-id="<? echo $program->ID ?>" data-document-id="<? echo $document->ID ?>">
                                                        </div>
                                                        <div class="wrap" style="width:100%;padding-right:10rem; overflow:hidden;">
                                                            <a href="" class="learn_lesson-doc_name">
                                                                <div class="text-wrapper">
                                                                    <? echo $document->Description ?>
                                                                </div>
                                                            </a>
                                                            <div class="mdi-b <? if ($document->Type == 'text') echo ('file');
                                                                                else echo ('video') ?>"></div>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                <? endforeach ?>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                <? else : ?>
                                    <div class="learn__lesson-item">
                                        <div class="learn__lesson-item-inner">
                                            <div class="">
                                                <a class="learn_lesson-name " role="button" aria-expanded="false">
                                                    <? echo $program->Description ?>
                                                    <span class="mdi-b toggle"></span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                <? endif ?>
                            <? endforeach ?>
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
        <script>
            function setUpVideoStream() {
                var video = document.getElementById("courseVideo");
                video.addEventListener("click", function() {
                    if (video.paused) {
                        video.play();
                    } else {
                        video.pause();
                    }
                });
                video.addEventListener("dblclick", function() {
                    video.currentTime += 10;
                });

            }
            setUpVideoStream();
        </script>
<?

    }

    // public function afterDocument()
    // {
    //     parent::afterDocument();
    // }
}
?>