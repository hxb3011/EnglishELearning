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
    function processCompletion($index, $text, $masks)
    {
        $result = '';
        $last_offset = 0;
        foreach ($masks as $mask) {
            $offset = +$mask->Offset;
            $length = +$mask->Length;
            $result .= mb_substr($text, $last_offset, $offset - $last_offset, 'UTF-8');
            $result .= "<input type='text' name='cau[{$index}][masks_content][]' placeholder='Điền từ...' />";
            $result .= "<input type='hidden' name='cau[{$index}][masks_id][]' value='{$mask->ID}' />";

            $last_offset = $offset + $length;
        }
        $result .= mb_substr($text, $last_offset, strlen($text) - $last_offset, 'UTF-8');

        return $result;
    }
    function processCompletionViewer()
    {
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
                                        <table class="table table-striped-columns table-bordered align-middle">
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
                                <? elseif ($this->currentProgram instanceof Excercise) : ?>
                                    <? if (!isset($this->currentProgram->response)) : ?>
                                        <form method="post" action="/courses/ajax_call_action.php?action=submit_test" class="card" style="padding: 12rem;" id="excerciseSMForm">
                                            <input type="hidden" name="courseId" value="<? echo ($this->course->id) ?>">
                                            <input type="hidden" name="excerciseId" value="<? echo ($this->currentProgram->ID) ?>">
                                            <div class="card-title">
                                                <b>Tên bài test : </b> <? echo  $this->currentProgram->Description ?>
                                            </div>
                                            <div class="card-description">
                                                <b>Deadline : </b> <? echo  $this->currentProgram->Deadline->format('d/m/Y H:i') ?>
                                            </div>
                                            <div class="card-body" id="excerciseContainer" style="padding:12rem;">
                                                <? foreach ($this->currentProgram->questions as $key => $question) : ?>
                                                    <? if (is_array($question->main) && $question->main[0] instanceof QMulchOption) : ?>
                                                        <div class="card" style="border-radius:6rem; overflow:hidden;<? if ($key != 0) echo ('margin-top:4rem;') ?>">
                                                            <input type="hidden" name="cau[<? echo $key + 1 ?>][type]" value="multi_option">
                                                            <input type="hidden" name="cau[<? echo $key + 1 ?>][questionId]" value="<? echo $question->ID ?>">
                                                            <div class="card-header text-white bg-primary" style="padding: 4rem; ">
                                                                Câu hỏi <? echo (($key + 1) . ' '); ?>:
                                                                <? echo ($question->Content) ?>
                                                            </div>
                                                            <div class="card-body" style="padding: 8rem;">
                                                                <? foreach ($question->main as $optionIndex => $option) : ?>
                                                                    <div class="d-flex align-items-center" style="padding: 2rem;">
                                                                        <label class="d-flex align-items-center">
                                                                            <input type="checkbox" class="question_checkbox" value="<?echo $option->ID?>" name="cau[<? echo $key + 1 ?>][option_select][]" style="margin-right:8rem;"> <? echo $option->Content ?>
                                                                        </label>
                                                                    </div>
                                                                <? endforeach ?>
                                                            </div>
                                                        </div>
                                                    <? elseif (is_array($question->main) && $question->main[0] instanceof QMatching) : ?>
                                                        <?
                                                        $keys = '';
                                                        foreach ($question->main as $index => $matching) {
                                                            $keys = $keys . "<option value='{$matching->QMatchingKey->ID}'>{$matching->QMatchingKey->Content}</option>";
                                                        }
                                                        ?>
                                                        <div class="card" style="border-radius:6rem; overflow:hidden;<? if ($key != 0) echo ('margin-top:12rem;') ?>">
                                                            <input type="hidden" name="cau[<? echo $key + 1 ?>][type]" value="matching">
                                                            <input type="hidden" name="cau[<? echo $key + 1 ?>][questionId]" value="<? echo $question->ID ?>">
                                                            <div class="card-header text-white bg-primary" style="padding: 4rem; ">
                                                                Câu hỏi <? echo (($key + 1) . ' '); ?>:
                                                                <? echo ($question->Content) ?>
                                                            </div>
                                                            <div class="card-body" style="padding: 8rem;">
                                                                <? foreach ($question->main as $index => $matching) : ?>
                                                                    <div class="d-flex align-items-center" style="padding: 2rem;">

                                                                        <label class="d-flex align-items-center" style="margin-right:12rem;"><? echo $matching->Content ?></label>
                                                                        <input type="hidden" name="cau[<? echo $key + 1 ?>][matching][]" value="<? echo $matching->ID ?>">
                                                                        <select class="question_select" name="cau[<? echo $key + 1 ?>][matchingkey][]">
                                                                            <? echo ($keys) ?>
                                                                        </select>
                                                                    </div>

                                                                <? endforeach ?>
                                                            </div>
                                                        </div>
                                                    <? elseif ($question->main instanceof QCompletion) : ?>
                                                        <div class="card" style="border-radius:6rem; overflow:hidden;<? if ($key != 0) echo ('margin-top:12rem;') ?>">
                                                            <input type="hidden" name="cau[<? echo $key + 1 ?>][type]" value="completion">
                                                            <input type="hidden" name="cau[<? echo $key + 1 ?>][questionId]" value="<? echo $question->ID ?>">
                                                            <div class="card-header text-white bg-primary" style="padding: 4rem; ">
                                                                Câu hỏi <? echo (($key + 1) . ' '); ?>:
                                                                <? echo ($question->Content) ?>
                                                            </div>
                                                            <div class="card-body" style="padding: 8rem;">
                                                                <div>
                                                                    <?
                                                                    echo $this->processCompletion($key + 1, $question->main->Content, $question->main->mask);
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <? endif ?>

                                                <? endforeach ?>
                                            </div>
                                            <div class="card-footer">
                                                <input type="submit" value="submit" placeholder="submit">
                                            </div>
                                        </form>

                                    <? endif ?>
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
                                                    <? $learnDocument = array_filter($this->tracking, function ($track) use ($program, $document) {
                                                        return $track->CourseID == $program->CourseID && $track->LearnedDocumentID == $document->ID;
                                                    }) ?>
                                                    <div class="learn_lesson-doc <? if (isset($this->currentProgram) && $this->currentProgram->ID == $document->ID) echo ('active') ?>">
                                                        <div style="margin-right:8rem;">
                                                            <input type="checkbox" class="learn__lesson-item-status" data-course-id="<? echo $program->CourseID ?>" <? if (!empty($learnDocument)) echo 'checked ' ?> data-document-id="<? echo $document->ID ?>">
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
                                                <a href="/courses/learn.php?courseId=<? echo $program->CourseID ?>&excerciseId=<? echo $program->ID ?>" class="learn_lesson-name " role="button" aria-expanded="false">
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
                    let profileId = <? echo $this->profileID ?>;
                    let documentId = $(this).data('document-id');
                    let courseId = $(this).data('course-id');
                    toastr.info("Vui lòng chờ thông báo tiếp theo", "Thông báo")
                    $.ajax({
                        url: 'http://localhost:62280/courses/ajax_call_action.php?action=update_tracking',
                        type: 'POST',
                        data: JSON.stringify({
                            courseId: courseId,
                            documentId: documentId,
                            checked: checked,
                            profileId: profileId
                        }),
                        success: function(response) {
                            let object = JSON.parse(response);
                            toastr.success(object.message, "Thông báo")
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