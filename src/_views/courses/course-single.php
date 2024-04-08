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
            "/clients/css/courses/course-single.css"
        );
        // $this->scripts(

        // );
    }

    public function body()
    {
        ?>
        <div class="breadcrumb-wrapper" style="background-color: #f0f0f0; padding-top:0.6rem;">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">Trang chủ</li>
                                <li class="breadcrumb-item ">Khóa học</li>
                                <li class="breadcrumb-item " aria-current="page">Tìm hiểu về web 2</li>
                            </ol>
                        </nav>
                    </div>
                </div>
        
            </div>
        </div>
        <div class="main">
            <div class="top">
                <div class="container">
                    <div class="row">
                        <div class="col-md-9 col-lg-9">
                            <div class="d-flex align-items-center justify-content-start">
                                <div class="course_category">
                                    Toeic
                                </div>
                                <span class="text-white ms-4 me-1" style="font-size: 1.2rem;">By</span>
                                <div class="course_tutor ms-2">
                                    Toàn Lê
                                </div>
                            </div>
                            <div class="course_name mt-4 mb-4">
                                The Ultimate Guild To Pass The English Test In Sai Gon University
                            </div>
                            <div class="d-flex justify-content-between align-items-center course_info ps-md-5 pe-md-5 pt-2 pb-2">
                                <div class="d-flex align-items-center justify-content-center">
                                    <i class="me-2 fa-solid fa-clock"></i>
                                    2 Tuần
                                </div>
                                <div class="d-flex align-items-center justify-content-center">
                                    <i class="me-2 fa-solid fa-graduation-cap"></i>
                                    150 Học Viên
                                </div>
                                <div class="d-flex align-items-center justify-content-center">
                                    <i class="me-2 fa-solid fa-book"></i>
                                    15 Bài học
                                </div>
                                <div class="d-flex align-items-center justify-content-center">
                                    <i class="me-2 fa-solid fa-question"></i>
                                    12 Bài Tập
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-3 position-relative">
                            <div class="card position-absolute course__wrapper">
                                <img src="/assets/images/blog4.png" alt="" class="card-img-top course__img">
                                <div class="card-body d-flex justify-content-between align-items-center pt-5 pb-4">
                                    <div class="card-text course_price">
                                        1200000
                                    </div>
                                    <a href="" class="btn course_gobtn">
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
                            <nav class="course_nav">
                                <div class="nav nav-tabs course_tab" id="nav-tab" role="tablist">
                                    <button class="nav-link course_tab-item active " id="nav-tong-quan-tab" data-bs-toggle="tab" data-bs-target="#nav-tong-quan" type="button" role="tab" aria-controls="nav-tong-quan" aria-selected="true">Tổng quan</button>
                                    <button class="nav-link course_tab-item" id="nav-chuong-trinh-tab" data-bs-toggle="tab" data-bs-target="#nav-chuong-trinh" type="button" role="tab" aria-controls="nav-chuong-trinh" aria-selected="false">Chương trình</button>
                                </div>
                            </nav>
                            <div class="tab-content course_tabContent" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-tong-quan" role="tabpanel" aria-labelledby="nav-tong-quan-tab" align="justify">
                                    Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae,
                                    eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,
                                </div>
                                <div class="tab-pane fade" id="nav-chuong-trinh" role="tabpanel" aria-labelledby="nav-chuong-trinh-tab">
                                    <div class="course_lesson d-flex justify-content-between align-items-center ps-4 pe-4 pt-3 pb-3 mt-4">
                                        <div class="course_lesson-title">
                                            <a href="">
                                                Lesson 1 : Title of the lesson
                                            </a>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="course_lesson_duration me-3">
                                                12:30
                                            </span>
                                            <i class="fa-solid fa-lock" class="me-2" style="font-size: 1.2rem;"></i>
                                            <!-- <i class="fa-solid fa-check"></i> -->
        
                                        </div>
                                    </div>
                                    <div class="course_lesson d-flex justify-content-between align-items-center ps-4 pe-4 pt-3 pb-3 mt-4">
                                        <div class="course_lesson-title">
                                            <a href="">
                                                Lesson 1 : Title of the lesson
                                            </a>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="course_lesson_duration me-3">
                                                12:30
                                            </span>
                                            <i class="fa-solid fa-lock" class="me-2" style="font-size: 1.2rem;"></i>
                                            <!-- <i class="fa-solid fa-check"></i> -->
        
                                        </div>
                                    </div>
                                    <div class="course_lesson d-flex justify-content-between align-items-center ps-4 pe-4 pt-3 pb-3 mt-4">
                                        <div class="course_lesson-title">
                                            <a href="">
                                                Lesson 1 : Title of the lesson
                                            </a>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="course_lesson_duration me-3">
                                                12:30
                                            </span>
                                            <i class="fa-solid fa-lock" class="me-2" style="font-size: 1.2rem;"></i>
                                            <!-- <i class="fa-solid fa-check"></i> -->
        
                                        </div>
                                    </div>
                                    <div class="course_lesson d-flex justify-content-between align-items-center ps-4 pe-4 pt-3 pb-3 mt-4">
                                        <div class="course_lesson-title">
                                            <a href="">
                                                Lesson 1 : Title of the lesson
                                            </a>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="course_lesson_duration me-3">
                                                12:30
                                            </span>
                                            <i class="fa-solid fa-lock" class="me-2" style="font-size: 1.2rem;"></i>
                                            <!-- <i class="fa-solid fa-check"></i> -->
        
                                        </div>
                                    </div>
                                    <div class="course_lesson d-flex justify-content-between align-items-center ps-4 pe-4 pt-3 pb-3 mt-4">
                                        <div class="course_lesson-title">
                                            <a href="">
                                                Lesson 1 : Title of the lesson
                                            </a>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="course_lesson_duration me-3">
                                                12:30
                                            </span>
                                            <i class="fa-solid fa-lock" class="me-2" style="font-size: 1.2rem;"></i>
                                            <!-- <i class="fa-solid fa-check"></i> -->
        
                                        </div>
                                    </div>
                                    <div class="course_lesson d-flex justify-content-between align-items-center ps-4 pe-4 pt-3 pb-3 mt-4">
                                        <div class="course_lesson-title">
                                            <a href="">
                                                Lesson 1 : Title of the lesson
                                            </a>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="course_lesson_duration me-3">
                                                12:30
                                            </span>
                                            <i class="fa-solid fa-lock" class="me-2" style="font-size: 1.2rem;"></i>
                                            <!-- <i class="fa-solid fa-check"></i> -->
        
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
    }

    // public function afterDocument()
    // {
    //     parent::afterDocument();
    // }
}
?>