<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("utils/htmlDocument.php");
class AddNewPost extends BaseHTMLDocumentPage
{
    public function __construct(){
        parent::__construct();
    }
    // public function beforeDocument()
    // {
    //     parent::beforeDocument();
    // }

    public function documentInfo(string $author, string $description, string $title){
        parent::documentInfo($author, $description, "Hồ sơ - " . $title);
    }

    public function openGraphInfo(string $image, string $description, string $title){
        parent::openGraphInfo($image, $description, "Hồ sơ - " . $title);
    }

    public function favIcon(string $ico = null, string $svg = null){
        parent::favIcon($ico, $svg);
    }

    public function head(){
        $this->styles(
            "/node_modules/bootstrap/dist/css/bootstrap.min.css",
            "/node_modules/summernote/dist/summernote-bs5.min.css",
            "/node_modules/toastr/build/toastr.css",
            "/clients/css/admin/main.css",
            "/clients/css/admin/addcourse.css"
        );
    }
    public function body(){
?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="admin-header">
                        <i class="mdi-b apple-keyboard-command admin-header__icon"></i>
                        Thêm bài post
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
                                            Thêm khóa học
                                        </span>
                                        <a type="button" href="/administration/courses/index.php" class="btn btn-outline-primary btn-rounded btn-icon">
                                            <span class="mdi-b back"></span> Danh sách khóa học
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div style="margin-top:24px; margin-bottom:24px;"></div>
                            <div class="row">
                                <div class="col-md-12">
                                    <form enctype="multipart/form-data" id="form_add_course" role="form" method="post" action="http://localhost:62280/administration/courses/add.php">
                                        <ul class="nav nav-justified nav-pills form-wizard-header">
                                            <li class="nav-item">
                                                <a class="nav-link rounded-0 pt-2 pb-2 active" data-bs-toggle="tab" href="#basic">
                                                    <span class="mdi-b fountain-pen"></span>
                                                    <span class="d-none d-sm-inline">Cơ bản</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link rounded-0 pt-2 pb-2" data-bs-toggle="tab" href="#tutor">
                                                    <span class="mdi-b camera-control"></span>
                                                    <span class="d-none d-sm-inline">Phân việc</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link rounded-0 pt-2 pb-2" data-bs-toggle="tab" href="#pricing">
                                                    <span class="mdi-b currency-cny"></span>
                                                    <span class="d-none d-sm-inline">Giá</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link rounded-0 pt-2 pb-2" data-bs-toggle="tab" href="#media">
                                                    <spanm class="mdi-b poster"></spanm>
                                                    <span class="d-none d-sm-inline">Poster</span>
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="tab-content b-0 mb-0 mt-4">
                                            <div class="tab-pane active" id="basic">
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
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="tutor">
                                                <div class="row justify-content-center">
                                                    <div class="col-xl-8">
                                                        <div class="form-group row mb-3">
                                                            <label class="col-md-2 col-form-label" for="tutor">Giảng viên</label>
                                                            <div class="col-md-10">
                                                                <select class="form-select form-select-md mb-3" name="tutor" id="tutor">
                                                                    <option value="">Lựa chọn giảng viên</option>
                                                                    <option value="PRO01">Lê Tấn Minh Toàn</option>
                                                                    <option value="B">Huỳnh Xuân Bách</option>
                                                                    <option value="C">Koong Chấn Phong</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="pricing">
                                                <div class="row justify-content-center">
                                                    <div class="col-xl-8">
                                                        <div class="form-group row mb-3">
                                                            <label class="col-md-2 col-form-label" for="price">Giá khóa học (VNĐ)<span class="required">*</span></label>
                                                            <div class="col-md-10">
                                                                <input type="number" class="form-control" id="price" name="price" placeholder="Nhập giá khóa học" min="0">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="media">
                                                <div class="row justify-content-center mb-4">
                                                    <div class="col-xl-8">
                                                        <div class="form-group row mb-3">
                                                            <label class="col-md-2 col-form-label" for="course_poster">Poster của khóa học<span class="required">*</span></label>
                                                            <div class="col-md-10">
                                                                <div class="wrapper-image-preview" style="margin-left: -6px;">
                                                                    <div class="box image-box">
                                                                        <div class="js--image-preview" style="background-image: url(https://placehold.co/600x600); background-color: #F5F5F5;"></div>
                                                                        <div class="upload-options">
                                                                            <label for="course_poster" class="btn" style="width:100%;"> <i class="mdi-b camera"></i> Poster <br> <small>(600 X 600)</small> </label>
                                                                            <input id="course_poster" style="visibility:hidden;" type="file" class="image-upload" name="course_poster" id="course_poster" accept="image/*">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-center">
                                                <button type="submit" class="btn btn-outline-primary btn-rounded btn-icon" id="submit_add_course">Xác nhận</button>
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
        <?
        $this->scripts(
            "/node_modules/jquery/dist/jquery.min.js",
            "/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js",
            "/node_modules/jquery-validation/dist/jquery.validate.min.js",
            "/node_modules/summernote/dist/summernote-bs5.min.js",
            "/node_modules/toastr/build/toastr.min.js",
            "/clients/js/admin/main.js",
        );
        ?>
        <script>
            $(document).ready(function() {
                // thêm summer note
                initSummerNote('#description');


                //thêm các validate rule cho form
                $("#form_add_course").validate({
                    ignore: [],
                    onkeyup: function(e) {
                        $(e).valid()
                    },
                    onchange:function(e){
                    },
                    errorPlacement: function() {},
                    invalidHandler: function() {
                        // setTimeout(function() {
                        //     $('.nav-tabs a small.required').remove();
                        //     var validatePane = $('.tab-content.tab-validate .tab-pane:has(input.error)').each(function() {
                        //         var id = $(this).attr('id');
                        //         $('.nav-tabs').find('a[href^="#' + id + '"]').append(' <small class="required">***</small>');
                        //     });
                        // });
                        toastr.error("Vui lòng kiểm tra lại các trường dữ liệu","Thêm khóa học : ")
                    },
                    rules: {
                        title: {
                            required: true,
                            minlength: 5
                        },
                        description: {
                            required: true,
                        },
                        start_date: {
                            required: true,
                            date: true
                        },
                        end_date: {
                            required: true,
                            date: true
                        },
                        tutor: {
                            required: true
                        },
                        course_poster: {
                            required: true
                        },
                        price: {
                            required: true
                        }
                    },
                    messages: {
                        title: {
                            required: "Vui lòng nhập tên khóa học",
                            minlength: "Độ dài của tên khóa học tối thiểu là 5"
                        },
                        description: {
                            required: "Vui lòng nhập mô tả khóa học",
                        },
                        start_date: {
                            required: "Vui lòng chọn ngày bắt đầu",
                            date: "Ngày tháng không hợp lệ"
                        },
                        end_date: {
                            required: "Vui lòng chọn ngày kết thúc",
                            date: "Ngày tháng không hợp lệ"
                        },
                        tutor: {
                            required: "Vui lòng chọn giáo viên"
                        },
                        course_poster: {
                            required: "Vui lòng chọn poster cho khóa học"
                        },
                        price: {
                            required: "Vui lòng nhập giá cho khóa học"
                        }
                    },
                    errorPlacement: function(error, element) {
                        error.insertAfter(element); // Place error message after the input element
                    },
                    submitHandler: function(form) {
                        form.submit()
                    }
                })
            })
            initImageUpload(document.getElementsByClassName('image-box')[0])
        </script>

<?
    }
}
