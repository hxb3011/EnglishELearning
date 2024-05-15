<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("utils/htmlDocument.php");

final class  MyCoursePage extends BaseHTMLDocumentPage
{
    public array $courses;
    public Profile $profile;
    public string $basePath;
    public int $totalLesson;
    public int $totalExcercise;
    public function __construct()
    {
        parent::__construct();
        $this->courses = array();
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
            "/clients/css/courses/all-courses.css",
        );
        $this->scripts(
            "/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js",
        );
    }

    public function body()
    {
?>
        <div class="wrapper">
            <div class="col-md-12">
                <div class="courses-section__head d-flex justify-content-between align-items-center">
                    <h3 class="courses-section__header">
                        Khóa học của tôi bạn
                    </h3>
                </div>
                <div class="courses-section__content container-fluid">
                    <? if ($this->courses != null) :  ?>
                        <? foreach ($this->courses as $index => $course) : ?>
                            <div class="row" style="<? if ($index > 0) echo "margin-top:14rem;" ?>">
                                <div class="col-md-12 col-sm-12">
                                    <div class="courses-section__content__course-item">
                                        <img src="<? echo ($this->basePath . $course->posterURI) ?>" class="courses-section__content__course-item-image">
                                        </img>
                                        <div class="courses-section__content__course-item__info d-flex justify-content-between flex-column">
                                            <div style="padding-top: 6rem; padding-bottom:6rem">
                                                <div class="course-item__info-section pt-2 pb-4">
                                                    <span class="course-item__info-section__author">GV: <? echo $course->tutorName ?></span>
                                                </div>
                                                <p class="course-item__info-section__title"><? echo $course->name ?></p>
                                                <div class="d-flex align-items-center justify-content-evenly" style=" flex-wrap: wrap;margin-top: 4rem; margin-bottom:4rem;">
                                                    <div class="d-flex justify-content-between align-items-center b">
                                                        <span class="mini-icon mdi-b calendar">
                                                        </span>
                                                        <span class="course-item__info-section__text">
                                                            <?
                                                            $interval = $course->beginDate->diff($course->endDate);
                                                            echo ($interval->days . ' Ngày')
                                                            ?>
                                                        </span>
                                                    </div>
                                                    <div class="d-flex justify-content-between align-items-center b">
                                                        <span class="mini-icon mdi-b student">
                                                        </span>
                                                        <span class="course-item__info-section__text">
                                                            <? echo ($course->totalStudent) ?> Học viên
                                                        </span>
                                                    </div>
                                                    <div class="d-flex justify-content-between align-items-center b ">
                                                        <span class="mini-icon mdi-b document">
                                                        </span>
                                                        <span class="course-item__info-section__text">
                                                            <?
                                                            echo (count($course->lessons) . 'Bài giảng')
                                                            ?>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between ps-3" style="padding-bottom: 6rem; padding-right:8rem;">
                                                <p class="course-item__info-section__price"><? echo $course->price ?> VND</p>

                                                <a href="/courses/detail.php?courseId=<? echo $course->id ?>" class="course-item__info-section__link">Xem chi tiết</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <? endforeach ?>
                    <? else : ?>
                        <h3 class="courses-section__header">
                            Bạn chưa có khóa học nào
                        </h3>
                    <? endif ?>
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