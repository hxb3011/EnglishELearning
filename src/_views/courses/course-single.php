<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("utils/htmlDocument.php");

final class CourseSinglePage extends BaseHTMLDocumentPage
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
                                <div class="course_category">
                                    Toeic
                                </div>
                                <span class="text-white ms-4 me-1" style="font-size: 10rem;">By</span>
                                <div class="course_tutor">
                                    Toàn Lê
                                </div>
                            </div>
                            <div class="course_name">
                                The Ultimate Guild To Pass The English Test In Sai Gon University
                            </div>
                            <div class="d-flex justify-content-between align-items-center course_info">
                                <div class="d-flex align-items-center justify-content-center">
                                    <span class="mdi-b student"></span>
                                    150 Học viên
                                </div>
                                <div class="d-flex align-items-center justify-content-center">
                                    <span class="mdi-b calendar"></span>
                                    2 Tuần
                                </div>

                                <div class="d-flex align-items-center justify-content-center">
                                    <span class="mdi-b document"></span>
                                    15 Bài học
                                </div>
                                <div class="d-flex align-items-center justify-content-center">
                                    <span class="mdi-b quiz"></span>
                                    12 Bài Tập
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-3 position-relative">
                            <div class="card position-absolute course__wrapper">
                                <img src="/assets/images/blog4.png" alt="" class="card-img-top course__img">
                                <div class="card-body d-flex justify-content-between align-items-center course__wrapper-inner">
                                    <div class="card-text course_price">
                                        1200000 VNĐ
                                    </div>
                                    <a href="/courses/learn.php?courseID=1" class="btn course_gobtn">
                                        Vào học
                                    </a>
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
                                    Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae,
                                    eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,
                                </div>
                                <div class="tab-pane fade" id="nav-chuong-trinh" role="tabpanel" aria-labelledby="nav-chuong-trinh-tab">
                                    <div class="course_lesson">
                                        <div class="course_lesson-title">
                                            <a data-bs-toggle="collapse" href="#collapse1" role="button" aria-expanded="false" aria-controls="collapse1">
                                                <span class="mdi-b toggle" styles="margin-right:4rem;"></span>
                                                Lesson 1 : Title of the lesson
                                            </a>
                                        </div>
                                        <div class="course_lesson-content collapse" id="collapse1" style="padding-left: 8rem;">
                                            <div class="course_lesson-doc">
                                                <span class="mdi-b video" style="margin-right:8rem;"></span>
                                                Hello World
                                            </div>
                                            <div class="course_lesson-doc">
                                                <span class="mdi-b file" style="margin-right:8rem;"></span>
                                                Hello World
                                            </div>
                                            <div class="course_lesson-doc">
                                                <span class="mdi-b quiz" style="margin-right:8rem;"></span>
                                                Hello World
                                            </div>
                                        </div>
                                    </div>
                                    <div class="course_lesson">
                                        <div class="course_lesson-title">
                                            <a data-bs-toggle="collapse" href="#collapse2" role="button" aria-expanded="false" aria-controls="collapse2">
                                                <span class="mdi-b toggle" styles="margin-right:4rem;"></span>
                                                Lesson 1 : Title of the lesson
                                            </a>
                                        </div>
                                        <div class="course_lesson-content collapse" id="collapse2" style="padding-left: 8rem;">
                                            <div class="course_lesson-doc">
                                                <span class="mdi-b video" style="margin-right:8rem;"></span>
                                                Hello World
                                            </div>
                                            <div class="course_lesson-doc">
                                                <span class="mdi-b file" style="margin-right:8rem;"></span>
                                                Hello World
                                            </div>
                                            <div class="course_lesson-doc">
                                                <span class="mdi-b quiz" style="margin-right:8rem;"></span>
                                                Hello World
                                            </div>
                                        </div>
                                    </div>
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