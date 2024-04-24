<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("utils/htmlDocument.php");
class EditCoursePage extends BaseHTMLDocumentPage
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
        parent::documentInfo($author, $description, "Khóa học- " . $title);
    }

    public function openGraphInfo(string $image, string $description, string $title)
    {
        parent::openGraphInfo($image, $description, "Hồ sơ - " . $title);
    }

    public function favIcon(string $ico = null, string $svg = null)
    {
        parent::favIcon($ico, $svg);
    }

    public function head()
    {
        $this->styles(
            "/node_modules/bootstrap/dist/css/bootstrap.min.css",
            "/node_modules/dragula/dist/dragula.min.css",
            "/node_modules/summernote/dist/summernote-bs5.min.css",
            "/clients/css/admin/main.css",
            "/clients/css/admin/addcourse.css"
        );
        $this->scripts(
            "/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js",
        );
    }
    public function body()
    {
?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="admin-header">
                        <i class="mdi mdi-apple-keyboard-command admin-header__icon"></i>
                        Sửa khóa học
                    </div>
                </div>
            </div>
            <div style="margin-top:10px; margin-bottom:10px"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span>
                                            Sửa khóa học
                                        </span>
                                        <a type="button" href="/administration/courses/index.php" class="btn btn-outline-primary btn-rounded btn-icon">
                                            <i class="mdi back"></i> Danh sách khóa học
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div style="margin-top:24px; margin-bottom:24px;"></div>
                            <div class="row">
                                <div class="col-md-12">
                                    <form class="" action="#" method="get" enctype="multipart/form-data">
                                        <div class="basicwizard">
                                            <ul class="nav nav-pills nav-justified form-wizard-header">
                                                <li class="nav-item">
                                                    <button id="nav_program" data-bs-toggle="tab" class="nav-link rounded-0 pt-2 pb-2 active" type="button" data-bs-target="#program" role="tab" aria-controls="program" aria-selected="true">
                                                        <i class="mdi program"></i>
                                                        <span class="d-none d-sm-inline">Chương trình</span>
                                                    </button>
                                                </li>
                                                <li class="nav-item">
                                                    <button id="nav_basic" data-bs-toggle="tab" class="nav-link rounded-0 pt-2 pb-2" type="button" data-bs-target="#basic" role="tab" aria-controls="basic" aria-selected="false">
                                                        <i class="mdi mdi-fountain-pen-tip"></i>
                                                        <span class="d-none d-sm-inline">Cơ bản</span>
                                                    </button>
                                                </li>
                                                <li class="nav-item">
                                                    <button id="nav_assign" data-bs-toggle="tab" class="nav-link rounded-0 pt-2 pb-2" type="button" data-bs-target="#tutor" role="tab" aria-controls="tutor" aria-selected="false">
                                                        <i class="mdi mdi-camera-control"></i>
                                                        <span class="d-none d-sm-inline">Phân việc</span>
                                                    </button>
                                                </li>
                                                <li class="nav-item">
                                                    <button data-bs-toggle="tab" id="nav_price" class="nav-link rounded-0 pt-2 pb-2" type="button" data-bs-target="#pricing" role="tab" aria-controls="pricing" aria-selected="false">
                                                        <i class="mdi mdi-currency-cny"></i>
                                                        <span class="d-none d-sm-inline">Giá</span>
                                                    </button>
                                                </li>
                                                <li class="nav-item">
                                                    <button data-bs-toggle="tab" id="nav_poster" class="nav-link rounded-0 pt-2 pb-2" type="button" data-bs-target="#media" role="tab" aria-controls="media" aria-selected="false">
                                                        <i class="mdi poster"></i>
                                                        <span class="d-none d-sm-inline">Poster</span>
                                                    </button>
                                                </li>
                                                <li class="nav-item">
                                                    <button data-bs-toggle="tab" id="nav_finish" class="nav-link rounded-0 pt-2 pb-2" type="button" data-bs-target="#finish" role="tab" aria-controls="finish" aria-selected="false">
                                                        <i class="mdi mdi-checkbox-marked-circle-outline"></i>
                                                        <span class="d-none d-sm-inline">Hoàn thành</span>
                                                    </button>
                                                </li>
                                            </ul>
                                            <div class="tab-content b-0 mb-0 mt-4">
                                                <div class="tab-pane active" id="program" role="tabpanel" aria-labelledby="nav_program">
                                                    <div class="row ">
                                                        <div class="col-md-12 mt-4 mb-4 d-flex justify-content-center">
                                                            <a href="javascript::void(0)" class="btn btn-outline-primary btn-rounded btn-sm ml-1 me-4" onclick="showAjaxModal('http://localhost:62280/administration/courses/modal/add_lesson.php','Thêm bài học')"><i class="mdi mdi-plus"></i> Thêm bài giảng</a>
                                                            <a href="javascript::void(0)" class="btn btn-outline-primary btn-rounded btn-sm ml-1" onclick="showAjaxModal('http://localhost:62280/administration/courses/modal/add_excercise.php','Thêm bài kiểm')"><i class="mdi mdi-plus"></i> Thêm bài kiểm</a>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-8 offset-md-2">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="d-flex align-items-center justify-content-end mb-2">
                                                                        <a href="javascript::void(0)" class="btn btn-outline-primary btn-rounded btn-sm ml-1 me-4" onclick="showLargeModal('http://localhost:62280/administration/courses/modal/sort_lesson.php', 'Sắp xếp khóa học')"><i class="mdi mdi-sort"></i> Sắp xếp khóa học</a>
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                <div class="col-12 mt-4">
                                                                    <div class="card bg-light text-seconday ps-4 pe-4">
                                                                        <div class="card-body">
                                                                            <div class="d-flex justify-content-between align-items-center">
                                                                                <div class="card-title">
                                                                                    Tên bài
                                                                                </div>
                                                                                <div class="card-widget">
                                                                                    <a href="javascript::void(0)" class="btn btn-outline-primary btn-rounded btn-sm ml-1" onclick="showLargeModal('http://localhost:62280/administration/courses/modal/sort_document.php', 'Sắp xếp bài giảng')"><i class="mdi mdi-sort"></i> Sắp xếp bài giảng</a>
                                                                                    <a href="javascript::void(0)" class="btn btn-outline-primary btn-rounded btn-sm ml-1" onclick="showAjaxModal('http://localhost:62280/administration/courses/modal/add_document.php','Thêm tài liệu')"><i class="mdi mdi-plus"></i> Thêm tài liệu</a>
                                                                                    <a href="javascript::void(0)" class="btn btn-outline-primary btn-rounded btn-sm ml-1" onclick="showAjaxModal('http://localhost:62280/administration/courses/modal/add_lesson.php', 'Sửa bài giảng')"><i class="mdi pen"></i> Sửa bài giảng</a>
                                                                                    <a href="javascript::void(0)" class="btn btn-outline-primary btn-rounded btn-sm ml-1" onclick=""><i class="mdi mdi-plus"></i> Xóa bài giảng</a>
                                                                                </div>
                                                                            </div>
                                                                            <div class="program__lesson bg-white ps-3 pe-3 pt-3 pb-3 mt-3 rounded-1 d-flex justify-content-between align-items-center" style="box-shadow: 0 0 35px 0 rgba(154, 161, 171, .15);">
                                                                                <h5 class="card-title mb-0">
                                                                                    <span class="font-weight-light">
                                                                                        <i class="mdi video"></i>
                                                                                        Hello
                                                                                    </span>
                                                                                </h5>
                                                                                <div class="card-widget">
                                                                                    <a href="" class="">
                                                                                        <i class="mdi pen"></i>
                                                                                    </a>
                                                                                    <a href="">
                                                                                        <i class="mdi close"></i>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                            <div class="program__lesson bg-white ps-3 pe-3 pt-3 pb-3 mt-3 rounded-1 d-flex justify-content-between align-items-center" style="box-shadow: 0 0 35px 0 rgba(154, 161, 171, .15);">
                                                                                <h5 class="card-title mb-0">
                                                                                    <span class="font-weight-light">
                                                                                        <i class="mdi document"></i>
                                                                                        Hello
                                                                                    </span>
                                                                                </h5>
                                                                                <div class="card-widget">
                                                                                    <a href="" class="">
                                                                                        <i class="mdi pen"></i>
                                                                                    </a>
                                                                                    <a href="">
                                                                                        <i class="mdi close"></i>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                            <div class="program__lesson bg-white ps-3 pe-3 pt-3 pb-3 mt-3 rounded-1 d-flex justify-content-between align-items-center" style="box-shadow: 0 0 35px 0 rgba(154, 161, 171, .15);">
                                                                                <h5 class="card-title mb-0">
                                                                                    <span class="font-weight-light">
                                                                                        <i class="mdi quiz"></i>
                                                                                        Hello
                                                                                    </span>
                                                                                </h5>
                                                                                <div class="card-widget">
                                                                                    <a href="" class="">
                                                                                        <i class="mdi pen"></i>
                                                                                    </a>
                                                                                    <a href="">
                                                                                        <i class="mdi close"></i>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 mt-4">
                                                                    <div class="card bg-light text-seconday ps-4 pe-4">
                                                                        <div class="card-body">
                                                                            <div class="d-flex justify-content-between align-items-center">
                                                                                <div class="card-title">
                                                                                    Kiểm tra
                                                                                </div>
                                                                                <div class="card-widget">
                                                                                    <a href="javascript::void(0)" class="btn btn-outline-primary btn-rounded btn-sm ml-1" onclick="showLargeModal('http://localhost:62280/administration/courses/modal/sort_excercise.php', 'Câu hỏi')"><i class="mdi mdi-sort"></i>Câu hỏi</a>
                                                                                    <a href="javascript::void(0)" class="btn btn-outline-primary btn-rounded btn-sm ml-1" onclick="showAjaxModal('http://localhost:62280/administration/courses/modal/add_lesson.php', 'Sửa bài kiểm')"><i class="mdi pen"></i> Sửa bài kiểm</a>
                                                                                    <a href="javascript::void(0)" class="btn btn-outline-primary btn-rounded btn-sm ml-1" onclick=""><i class="mdi mdi-plus"></i> Xóa bài kiểm</a>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="basic" role="tabpanel" aria-labelledby="nav_basic" >
                                                    <div class="row justify-content-center">
                                                        <div class="col-xl-8">
                                                            <input type="hidden" name="course_type" value="general">
                                                            <div class="form-group row mb-3">
                                                                <label class="col-md-2 col-form-label" for="course_title">Tên khóa học <span class="required">*</span> </label>
                                                                <div class="col-md-10">
                                                                    <input type="text" class="form-control" id="course_title" name="title" placeholder="Nhập tên khóa học">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row mb-3">
                                                                <label class="col-md-2 col-form-label" for="description">Mô tả <span class="required">*</span></label>
                                                                <div class="col-md-10">
                                                                    <textarea name="description" id="description" class="form-control" style="display: none;"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row mb-3">
                                                                <label class="col-md-2 col-form-label" for="start_date">Ngày bắt đầu <span class="required">*</span> </label>
                                                                <div class="col-md-10">
                                                                    <input type="datetime-local" class="form-control" id="start_date" name="start_date" placeholder="Chọn ngày bắt đầu">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row mb-3">
                                                                <label class="col-md-2 col-form-label" for="end_date">Ngày kết thúc <span class="required">*</span> </label>
                                                                <div class="col-md-10">
                                                                    <input type="datetime-local" class="form-control" id="end_date" name="end_date" placeholder="Chọn kết thúc">
                                                                </div>
                                                            </div>
                                                        </div> <!-- end col -->
                                                    </div> <!-- end row -->
                                                </div> <!-- end tab pane -->
                                                <div class="tab-pane" role="tabpanel" aria-labelledby="nav_assign" id="tutor">
                                                    <div class="row justify-content-center">
                                                        <div class="col-xl-8">
                                                            <div class="form-group row mb-3">
                                                                <label class="col-md-2 col-form-label" for="tutor">Giảng viên</label>
                                                                <div class="col-md-10">
                                                                    <select class="form-select form-select-md mb-3" name="tutor" id="tutor">
                                                                        <option>Lựa chọn giảng viên</option>
                                                                        <option value="A">Lê Tấn Minh Toàn</option>
                                                                        <option value="B">Huỳnh Xuân Bách</option>
                                                                        <option value="C">Koong Chấn Phong</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane" role="tabpanel" aria-labelledby="nav_price" id="pricing">
                                                    <div class="row justify-content-center">
                                                        <div class="col-xl-8">
                                                            <div class="paid-course-stuffs">
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-2 col-form-label" for="price">Giá khóa học (VNĐ)</label>
                                                                    <div class="col-md-10">
                                                                        <input type="number" class="form-control" id="price" name="price" placeholder="Nhập giá khóa học" min="0">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div> <!-- end col -->
                                                    </div> <!-- end row -->
                                                </div> <!-- end tab-pane -->
                                                <div class="tab-pane" role="tabpanel" aria-labelledby="nav_poster" id="media">
                                                    <div class="row justify-content-center">
                                                        <!-- this portion will be generated theme wise from the theme-config.json file Starts-->
                                                        <div class="col-xl-8">
                                                            <div class="form-group row mb-3">
                                                                <label class="col-md-2 col-form-label" for="course_poster_label">Poster của khóa học</label>
                                                                <div class="col-md-10">
                                                                    <div class="wrapper-image-preview" style="margin-left: -6px;">
                                                                        <div class="box image-box">
                                                                            <div class="js--image-preview" style="background-image: url(https://placehold.co/600x600); background-color: #F5F5F5;"></div>
                                                                            <div class="upload-options">
                                                                                <label for="course_poster" class="btn"> <i class="mdi mdi-camera"></i> Poster <br> <small>(600 X 600)</small> </label>
                                                                                <input id="course_poster" style="visibility:hidden;" type="file" class="image-upload" name="course_poster" id="course_poster" accept="image/*">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- this portion will be generated theme wise from the theme-config.json file Ends-->
                                                    </div> <!-- end row -->
                                                </div>
                                                <div class="tab-pane" role="tabpanel" aria-labelledby="nav_finish" id="finish">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="text-center">
                                                                <h2 class="mt-0"><i class="mdi mdi-check-all"></i></h2>
                                                                <h3 class="mt-0">Xác nhận tạo khóa học</h3>

                                                                <p class="w-75 mb-2 mx-auto">Nhấn vào nút bên dưới</p>

                                                                <div class="mb-3 mt-3">
                                                                    <button type="submit" class="btn btn-primary text-center" id="submit_add_course">Xác nhận</button>
                                                                </div>
                                                            </div>
                                                        </div> <!-- end col -->
                                                    </div> <!-- end row -->
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="scrollable-modal" tabindex="-1" role="dialog" aria-labelledby="scrollableModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header justify-content-between">
                        <h5 class="modal-title" id="scrollableModalTitle">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body ml-2 mr-2">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng lại</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        <div class="modal fade" id="large-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">Large modal</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        <?
        $this->scripts(
            "/node_modules/jquery/dist/jquery.min.js",
            "/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js",
            "/node_modules/sweetalert/dist/sweetalert.min.js",
            "/node_modules/summernote/dist/summernote-bs5.min.js",
            "/node_modules/dragula/dist/dragula.min.js",
            "/node_modules/jquery-validation/dist/jquery.validate.min.js",
            "/clients/js/admin/main.js"
        );
        ?>
        <script>
            $(document).ready(function() {
                initSummerNote('#description');
            })
        </script>
<?
    }
}
