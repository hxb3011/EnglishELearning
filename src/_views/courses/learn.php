<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("utils/htmlDocument.php");

final class LearnPage extends BaseHTMLDocumentPage
{
    public $hideNav = true;
    public Course $course;
    public array $programs;
    public $currentProgram;
    public array $tracking = array();
    public $profileID;
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
        parent::documentInfo($author, $description, $this->course->name . '-' . $title);
    }

    public function openGraphInfo(string $image, string $description, string $title)
    {
        parent::openGraphInfo($image, $description, $this->course->name . '-' . $title);
    }

    public function favIcon(string $ico = null, string $svg = null)
    {
        parent::favIcon($ico, $svg);
    }

    public function head()
    {
        $this->styles(
            "/node_modules/bootstrap/dist/css/bootstrap.min.css",
            "/node_modules/toastr/build/toastr.css",
            "/node_modules/sweetalert2/dist/sweetalert2.min.css",
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
                            <? if (isset($this->currentProgram)) : ?>
                                <? if ($this->currentProgram instanceof Document && $this->currentProgram->Type == 'video') : ?>
                                    <div class="learn__video-wrapper" id="video-container">
                                        <video id="courseVideo" preload="auto" src="<? echo $this->currentProgram->DocUri ?>" controls controlslist="nodownload" src="" class="learn__video"></video>
                                    </div>
                                <? elseif ($this->currentProgram instanceof Document && $this->currentProgram->Type == 'text') : ?>
                                    <div id="documentText-container" style="padding: 24rem;">
                                        <table class="table table-striped table-bordered align-middle">
                                            <tbody>
                                                <tr>
                                                    <td class="text-center" style="padding: 8rem;">Tên tài liệu</td>
                                                    <td class="text-center" style="padding: 8rem;"><? echo $this->currentProgram->Description ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center" style="padding: 8rem;">Tải tài liệu</td>
                                                    <td class="text-center" style="padding: 8rem;">
                                                        <a type="button" class="btn" href="<? echo $this->currentProgram->DocUri ?>" id="btnDownload">
                                                            <span class="mdi-b back"></span> Tải về
                                                        </a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                <? elseif ($this->currentProgram) : ?>

                                <? endif ?>
                            <? else : ?>
                            <? endif ?>
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
                                            <div class="collapse" id="collapse<? echo $index + 1 ?>" style=" padding-left: 12rem; padding-right:12rem;">
                                                <? foreach ($program->Documents as $index => $document) : ?>
                                                    <? $learnDocument = array_filter($this->tracking,function($track) use($program,$document){
                                                             return $track->CourseID == $program->CourseID && $track->LearnedDocumentID== $document->ID ;
                                                    })?>
                                                    <div class="learn_lesson-doc">
                                                        <div style="margin-right:8rem;">
                                                            <input type="checkbox"  class="learn__lesson-item-status" data-course-id="<? echo $program->CourseID ?>"  <? if(!empty($learnDocument)) echo 'checked'?> data-document-id="<? echo $document->ID ?> ?>">
                                                        </div>
                                                        <div class="wrap" style="width:100%;padding-right:10rem; overflow:hidden;">
                                                            <a href="/courses/learn.php?courseId=<? echo $program->CourseID ?>&documentId=<? echo $document->ID ?>" class="learn_lesson-doc_name">
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
            "/node_modules/toastr/build/toastr.min.js",
            "/node_modules/sweetalert2/dist/sweetalert2.min.js",
        );
        ?>
        <script>
            (function() {
                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "2000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
              
            })();
        </script>
        <script>
            $(document).ready(function() {
                $('.learn__lesson-item-status').change(function() {
                    let checked = $(this).is(':checked') ? 'checked' : 'unchecked';
                    let profileId = <?echo $this->profileID?>;
                    let documentId = $(this).data('document-id')
                    let courseId = $(this).data('course-id')
                    toastr.info("Vui lòng chờ thông báo tiếp theo","Thông báo")
                    console.log('hehe')
                    $.ajax({
                        url: 'http://localhost:62280/courses/ajax_call_action.php?action=update_tracking',
                        type: 'POST',
                        data: JSON.stringify({
                            courseId: courseId,
                            documentId: documentId,
                            checked : checked,
                            profileId:profileId
                        }),
                        success: function(response) {
                            toastr.success(response);
                        }
                    })
                })
            })
        </script>
<?

    }

    // public function afterDocument()
    // {
    //     parent::afterDocument();
    // }
}
?>