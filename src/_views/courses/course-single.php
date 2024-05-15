<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("utils/htmlDocument.php");

final class CourseSinglePage extends BaseHTMLDocumentPage
{
    public Course $course;
    public array $programs = array();
    public string $basePath;
    public int $totalLesson;
    public int $totalExcercise;
    public bool $isRegistered;
    public bool $isRegisterable;
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
        parent::favIcon("/assets/images/logo-icon.png", $svg);
    }

    public function head()
    {
        $this->styles(
            "/node_modules/bootstrap/dist/css/bootstrap.min.css",
            "/clients/css/pagination.css",
            "/clients/css/courses/course-single.css",
        );
        $this->scripts(
            "/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js",
        );
    }

    public function body()
    {
?>
        <div class="wrapper">
            <div class="top">
                <div class="container">
                    <div class="row">
                        <div class="col-md-9 col-lg-9">
                            <div class="d-flex align-items-center justify-content-start">
                                <span class="text-white ms-4 me-1" style="font-size: 14rem;">Giảng dạy bởi : </span>
                                <div class="course_tutor">
                                    <? echo $this->course->tutorName ?>
                                </div>
                            </div>
                            <div class="course_name">
                                <? echo $this->course->name ?>
                            </div>
                            <div class="d-flex justify-content-between align-items-center course_info">
                                <div class="d-flex align-items-center justify-content-center">
                                    <span class="mdi-b student" style="font-size: 18rem;"></span>
                                    <? echo ($this->course->totalStudent) ?> Học viên
                                </div>
                                <div class="d-flex align-items-center justify-content-center">
                                    <span class="mdi-b calendar"></span>
                                    <?
                                    $interval = $this->course->beginDate->diff($this->course->endDate);
                                    echo ($interval->days . ' Ngày')
                                    ?>
                                </div>

                                <div class="d-flex align-items-center justify-content-center">
                                    <span class="mdi-b document" style="font-size: 18rem;"></span>
                                    <? echo ($this->totalLesson) ?> Bài học
                                </div>
                                <div class="d-flex align-items-center justify-content-center">
                                    <span class="mdi-b quiz" style="font-size: 18rem;"></span>
                                    <? echo ($this->totalExcercise) ?> Bài Tập
                                </div>
                            </div>
                            <div class="d-flex justify-content-start align-items-center course_info" style="margin-top:24rem;">
                                <div class="d-flex align-items-center " style="margin-right:20rem;">
                                    <span class="mdi-b start-date" style="font-size: 18rem;"></span>
                                    Bắt đầu : <? echo ($this->course->beginDate->format('d-m-Y H:i:s')) ?>
                                </div>
                                <div class="d-flex align-items-center ">
                                    <span class="mdi-b end-date" style="font-size: 18rem;"></span>
                                    Kết thúc : <? echo ($this->course->endDate->format('d-m-Y H:i:s')) ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-3 position-relative">
                            <div class="card position-absolute course__wrapper">
                                <img src="<? echo ($this->basePath . $this->course->posterURI) ?>" alt="" class="card-img-top course__img">
                                <div class="card-body d-flex justify-content-between align-items-center course__wrapper-inner">
                                    <div class="card-text course_price">
                                        <? echo ($this->course->price) ?> VNĐ
                                    </div>
                                    <? if (isset($this->isRegistered) && ($this->isRegistered == true)) : ?>
                                        <a href="/courses/learn.php?courseId=<? echo $this->course->id ?>" class="btn course_gobtn">
                                            Vào học
                                        </a>
                                    <? elseif (!isset($this->isRegistered) || ($this->isRegistered == false)): ?>
                                        <? if ($this->isRegisterable) : ?>
                                            <a href="/courses/learn.php?courseId=<? echo $this->course->id ?>" class="btn course_gobtn">
                                                Đăng ký
                                            </a>
                                        <? else : ?>
                                            <p style="font-size: 18rem;">Quá hạn đăng ký</p>
                                    <? endif ?>
                                    <? endif ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="main-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-9 col-lg-9">
                            <div class="course_nav">
                                <div class="nav nav-tabs course_tab" id="nav-tab" role="tablist">
                                    <button class="nav-link course_tab-item active " id="nav-tong-quan-tab" data-bs-toggle="tab" data-bs-target="#nav-tong-quan" type="button" role="tab" aria-controls="nav-tong-quan" aria-selected="true">Tổng quan</button>
                                    <button class="nav-link course_tab-item" id="nav-chuong-trinh-tab" data-bs-toggle="tab" data-bs-target="#nav-chuong-trinh" type="button" role="tab" aria-controls="nav-chuong-trinh" aria-selected="false">Chương trình</button>
                                </div>
                            </div>
                            <div class="tab-content course_tabContent" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-tong-quan" role="tabpanel" aria-labelledby="nav-tong-quan-tab" align="justify">
                                    <? echo ($this->course->description) ?>
                                </div>
                                <div class="tab-pane fade" id="nav-chuong-trinh" role="tabpanel" aria-labelledby="nav-chuong-trinh-tab">
                                    <? foreach ($this->programs as $index => $program) : ?>
                                        <? if ($program instanceof Lesson) : ?>
                                            <div class="course_lesson">
                                                <div class="course_lesson-title">
                                                    <a data-bs-toggle="collapse" href="#collapse<? echo ($index + 1) ?>" role="button" aria-expanded="false" aria-controls="collapse1">
                                                        <span class="mdi-b toggle" styles="margin-right:4rem;"></span>
                                                        <? echo ($program->Description) ?>
                                                    </a>
                                                </div>
                                                <div class="course_lesson-content collapse" id="collapse<? echo ($index + 1) ?>" style="padding-left: 8rem;">
                                                    <? foreach ($program->Documents as $index => $document) : ?>
                                                        <div class="course_lesson-doc">
                                                            <span class="mdi-b <? if ($document->Type == 'text') echo ('file');
                                                                                else echo ('video') ?>" style="margin-right:8rem;"></span>
                                                            <? echo $document->Description ?>
                                                        </div>
                                                    <? endforeach ?>
                                                </div>
                                            </div>
                                        <? else : ?>
                                            <div class="course_lesson">
                                                <div class="course_lesson-title">
                                                    <a role="button" aria-expanded="false">
                                                        <span class="mdi-b quiz" styles="margin-right:4rem;"></span>
                                                        <? echo ($program->Description) ?>
                                                    </a>
                                                </div>
                                            </div>
                                        <? endif ?>
                                    <? endforeach ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


<?
        $this->scripts(
            "/node_modules/jquery/dist/jquery.min.js",
        );
    }

    // public function afterDocument()
    // {
    //     parent::afterDocument();
    // }
}
?>