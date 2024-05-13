<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("utils/htmlDocument.php");
class EditPost extends BaseHTMLDocumentPage
{
    public Post $post;
    public array $programs;
    public string $basePath;
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
            "/node_modules/summernote/dist/summernote-bs5.min.css",
            "/node_modules/toastr/build/toastr.css",
            "/node_modules/dragula/dist/dragula.min.css",
            "/node_modules/sweetalert2/dist/sweetalert2.min.css",
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
                        <i class="mdi-b apple-keyboard-command admin-header__icon"></i>
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
                                            <i class="mdi-b back"></i> Danh sách khóa học
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div style="margin-top:24px; margin-bottom:24px;"></div>
                            <div class="row">
                                <div class="col-md-12">
                                    <form class="" action="/administration/courses/edit.php" id="form_edit_course" method="post" enctype="multipart/form-data">
                                        <div class="basicwizard">
                                            <ul class="nav nav-pills nav-justified form-wizard-header">
                                                <li class="nav-item">
                                                    <a id="nav_program" class="nav-link rounded-0 pt-2 pb-2 active" data-bs-toggle="tab" href="#program">
                                                        <i class="mdi-b program"></i>
                                                        <span class="d-none d-sm-inline">Chương trình</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link rounded-0 pt-2 pb-2" data-bs-toggle="tab" href="#basic">
                                                        <i class="mdi-b fountain-pen"></i>
                                                        <span class="d-none d-sm-inline">Cơ bản</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link rounded-0 pt-2 pb-2" data-bs-toggle="tab" href="#tutor">
                                                        <i class="mdi-b camera-control"></i>
                                                        <span class="d-none d-sm-inline">Phân việc</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link rounded-0 pt-2 pb-2" data-bs-toggle="tab" href="#pricing">
                                                        <i class="mdi-b currency-cny"></i>
                                                        <span class="d-none d-sm-inline">Giá</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link rounded-0 pt-2 pb-2" data-bs-toggle="tab" href="#media">
                                                        <i class="mdi-b poster"></i>
                                                        <span class="d-none d-sm-inline">Poster</span>
                                                    </a>
                                                </li>
                                            </ul>
                                            <div class="tab-content b-0 mb-0 mt-4">
                                                <div class="tab-pane active" id="program" role="tabpanel" aria-labelledby="nav_program">
                                                    <div class="row ">
                                                        <div class="col-md-12 mt-4 mb-4 d-flex justify-content-center">
                                                            <a href="javascript::void(0)" class="btn btn-outline-primary btn-rounded btn-sm ml-1 me-4" onclick="showAjaxModal('http://localhost:62280/administration/courses/show_modal.php?action=lesson_modal&courseId=<? echo $this->post->SubId ?>','Thêm bài học')"><i class="mdi-b plus"></i> Thêm bài giảng</a>
                                                            <a href="javascript::void(0)" class="btn btn-outline-primary btn-rounded btn-sm ml-1" onclick="showAjaxModal('http://localhost:62280/administration/courses/show_modal.php?action=excercise_modal&courseId=<? echo $this->post->SubId ?>','Thêm bài kiểm')"><i class="mdi-b plus"></i> Thêm bài kiểm</a>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-8 offset-md-2">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="d-flex align-items-center justify-content-end mb-2">
                                                                        <a href="javascript::void(0)" class="btn btn-outline-primary btn-rounded btn-sm ml-1 me-4" onclick="showLargeModal('http://localhost:62280/administration/courses/show_modal.php?action=sort_program_modal&courseId=<? echo ($this->post->SubId); ?>', 'Sắp xếp khóa học')"><i class="mdi-b sort"></i> Sắp xếp khóa học</a>
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                <? foreach ($this->programs as $index =>  $program) : ?>
                                                                    <? if ($program instanceof Lesson) : ?>
                                                                        <div class="col-12 mt-4">
                                                                            <div class="card bg-light text-seconday ps-4 pe-4 on-hover-action" id="<? echo ($program->ID) ?>">
                                                                                <div class="card-body">
                                                                                    <div class="d-flex justify-content-between align-items-center">
                                                                                        <div class="card-title">
                                                                                            <? echo ($program->Description); ?>
                                                                                        </div>
                                                                                        <div class="card-widget" id="<? echo ("widget-of-" . $program->ID) ?>" style="display:none;">
                                                                                            <a href="javascript::void(0)" class="btn btn-outline-primary btn-rounded btn-sm ml-1" onclick="showLargeModal('http://localhost:62280/administration/courses/show_modal.php?action=sort_document_modal&lessonId=<? echo ($program->ID); ?>', 'Sắp xếp bài giảng')"><i class="mdi-b sort"></i> Sắp xếp bài giảng</a>
                                                                                            <a href="javascript::void(0)" class="btn btn-outline-primary btn-rounded btn-sm ml-1" onclick="showAjaxModal('http://localhost:62280/administration/courses/show_modal.php?action=document_modal&lessonId=<? echo ($program->ID); ?>','Thêm tài liệu')"><i class="mdi-b plus"></i> Thêm tài liệu</a>
                                                                                            <a href="javascript::void(0)" class="btn btn-outline-primary btn-rounded btn-sm ml-1" onclick="showAjaxModal('http://localhost:62280/administration/courses/show_modal.php?action=lesson_modal&editmode=1&lessonId=<? echo ($program->ID); ?>', 'Sửa bài giảng')"><i class="mdi-b pen"></i> Sửa bài giảng</a>
                                                                                            <a href="javascript::void(0)" class="btn btn-outline-primary btn-rounded btn-sm ml-1" onclick="confirm_delete_modal('http://localhost:62280/administration/courses/api/ajax_call_action.php?action=delete_lesson&lessonId=<? echo ($program->ID); ?>','Xóa bài giảng','Bạn có chắc muốn xóa bài giảng này')"><i class="mdi-b delete"></i> Xóa bài giảng</a>
                                                                                        </div>
                                                                                    </div>
                                                                                    <? foreach ($program->Documents as $index => $document) : ?>
                                                                                        <div class="program__lesson bg-white ps-3 pe-3 pt-3 pb-3 mt-3 rounded-1 d-flex justify-content-between align-items-center" style="box-shadow: 0 0 35px 0 rgba(154, 161, 171, .15);">
                                                                                            <h5 class="card-title mb-0">
                                                                                                <span class="font-weight-light">
                                                                                                    <? if ($document->Type == "VIDEO") : ?>
                                                                                                        <i class="mdi-b video"></i>
                                                                                                    <? else : ?>
                                                                                                        <i class="mdi-b document"></i>
                                                                                                    <? endif ?>

                                                                                                    <? echo ($document->Description) ?>
                                                                                                </span>
                                                                                            </h5>
                                                                                            <div class="card-widget">
                                                                                                <a class="" onclick="showAjaxModal('http://localhost:62280/administration/courses/show_modal.php?action=document_modal&editmode=1&lessonId=<?echo($document->LessonID)?>&documentId=<? echo ($document->ID) ?>','Sửa tài liệu tài liệu')">
                                                                                                    <i class="mdi-b pen"></i>
                                                                                                </a>
                                                                                                <a onclick="confirm_delete_modal('http://localhost:62280/administration/courses/api/ajax_call_action.php?action=delete_document&documentId=<? echo ($document->ID) ?>','Xóa tài liệu','Bạn có chắc muốn xóa tài liệu này')">
                                                                                                    <i class="mdi-b close"></i>
                                                                                                </a>
                                                                                            </div>
                                                                                        </div>
                                                                                    <? endforeach ?>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    <? else : ?>
                                                                        <div class="col-12 mt-4">
                                                                            <div class="card bg-light text-seconday ps-4 pe-4 on-hover-action" id="<? echo ("EXCERCISE" . $program->ID) ?>">
                                                                                <div class="card-body">
                                                                                    <div class="d-flex justify-content-between align-items-center">
                                                                                        <div class="card-title">
                                                                                            <? echo ($program->Description); ?>
                                                                                        </div>
                                                                                        <div class="card-widget" id="<? echo ("widget-of-EXCERCISE" . $program->ID); ?>" style="display:none;">
                                                                                            <a href="javascript::void(0)" class="btn btn-outline-primary btn-rounded btn-sm ml-1" onclick="showLargeModal('http://localhost:62280/administration/courses/show_modal.php?action=sort_excercise_modal&excerciseId=<? echo $program->ID ?>', 'Câu hỏi')"><i class="mdi-b sort"></i>Câu hỏi</a>
                                                                                            <a href="javascript::void(0)" class="btn btn-outline-primary btn-rounded btn-sm ml-1" onclick="showAjaxModal('http://localhost:62280/administration/courses/show_modal.php?action=excercise_modal&editmode=1&excerciseId=<? echo $program->ID ?>', 'Sửa bài kiểm')"><i class="mdi-b pen"></i> Sửa bài kiểm</a>
                                                                                            <a href="javascript::void(0)" class="btn btn-outline-primary btn-rounded btn-sm ml-1" onclick="confirm_delete_modal('http://localhost:62280/administration/courses/api/ajax_call_action.php?action=delete_excercise&excerciseId=<? echo $program->ID ?>','Xóa bài kiểm','Bạn có chắc muốn xóa bài kiểm này')"><i class="mdi-b delete"></i> Xóa bài kiểm</a>
                                                                                        </div>
                                                                                    </div>

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    <? endif ?>
                                                                <? endforeach ?>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="basic">
                                                    <div class="row justify-content-center">
                                                        <div class="col-xl-8">
                                                            <input type="hidden" name="courseID" value="<? echo $this->post->SubId; ?>">
                                                            <div class="form-group row mb-3">
                                                                <label class="col-md-2 col-form-label" for="course_title">Tên khóa học <span class="required">*</span> </label>
                                                                <div class="col-md-10">
                                                                    <input type="text" class="form-control" id="course_title" name="title" placeholder="Nhập tên khóa học" value="<? echo ($this->post->title); ?>">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row mb-3">
                                                                <label class="col-md-2 col-form-label" for="description">Mô tả <span class="required">*</span></label>
                                                                <div class="col-md-10">
                                                                    <textarea name="description" id="description" class="form-control" style="display: none;">
                                                                        <? echo ($this->post->title); ?>
                                                                    </textarea>
                                                                </div>
                                                            </div>
                                                            <!--
                                                            <div class="form-group row mb-3">
                                                                <label class="col-md-2 col-form-label" for="start_date">Ngày bắt đầu <span class="required">*</span> </label>
                                                                <div class="col-md-10">
                                                                    <input type="datetime-local" class="form-control" id="start_date" name="start_date" placeholder="Chọn ngày bắt đầu" value="<? /*echo ($this->post->beginDate->format('Y-m-d\TH:i')); ?>">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row mb-3">
                                                                <label class="col-md-2 col-form-label" for="end_date">Ngày kết thúc <span class="required">*</span> </label>
                                                                <div class="col-md-10">
                                                                    <input type="datetime-local" class="form-control" id="end_date" name="end_date" placeholder="Chọn kết thúc" value="<? /*echo ($this->course->endDate->format('Y-m-d\TH:i')); ?>">
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
                                                                        <option>Lựa chọn giảng viên</option>
                                                                        <? /*foreach ($this->tutors as $tutor) : ?>
                                                                            <option value="<? echo $tutor['ID']; ?>" <? if ($tutor['ID'] == $this->course->profileID) echo ('selected')  ?>><? echo $tutor['Name'] ?></option>
                                                                        <? endforeach ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="pricing">
                                                    <div class="row justify-content-center">
                                                        <div class="col-xl-8">
                                                            <div class="paid-course-stuffs">
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-2 col-form-label" for="price">Giá khóa học <span class="required">*</span></label>
                                                                    <div class="col-md-10">
                                                                        <input type="number" class="form-control" id="price" name="price" placeholder="Nhập giá khóa học" min="0" value="<? echo ($this->course->price); ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="media">
                                                    <div class="row justify-content-center">
                                                        <div class="col-xl-8">
                                                            <div class="form-group row mb-3">
                                                                <label class="col-md-2 col-form-label" for="course_poster_label">Poster của khóa học</label>
                                                                <div class="col-md-10">
                                                                    <div class="wrapper-image-preview" style="margin-left: -6px;">
                                                                        <div class="box image-box">
                                                                            <div class="js--image-preview" style="background-image: url(<? echo ($this->basePath . $this->course->posterURI) ?>); background-color: #F5F5F5;"></div>
                                                                            <div class="upload-options">
                                                                                <label for="course_poster" class="btn"> <i class="mdi-b camera"></i> Poster <br> <small>(600 X 600)</small> </label>
                                                                                <input id="course_poster" style="visibility:hidden;" type="file" class="image-upload" name="course_poster" id="course_poster" accept="image/*">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-center mt-4">
                                                    <button type="submit" class="btn btn-outline-primary btn-rounded btn-icon" id="submit_add_course">Xác nhận</button>
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
            "/node_modules/jquery-validation/dist/jquery.validate.min.js",
            "/node_modules/summernote/dist/summernote-bs5.min.js",
            "/node_modules/dragula/dist/dragula.min.js",
            "/node_modules/toastr/build/toastr.min.js",
            "/node_modules/sweetalert2/dist/sweetalert2.min.js",
            "/clients/js/admin/main.js",

        );
        ?>
        <script>
            $(document).ready(function() {
                // thêm summer note
                initSummerNote('#description');
                //thêm các validate rule cho form
                $("#form_edit_course").validate({
                    ignore: [],
                    onkeyup: function(e) {
                        $(e).valid()
                    },
                    onchange: function(e) {},
                    errorPlacement: function() {},
                    invalidHandler: function() {
                        toastr.error("Vui lòng kiểm tra lại các trường dữ liệu", "Sửa khóa học : ")
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

                $('.on-hover-action').mouseenter(function() {
                    let id = this.id;
                    $('#widget-of-' + id).show()
                })

                $('.on-hover-action').mouseleave(function() {
                    let id = this.id;
                    $('#widget-of-' + id).hide()
                })
            })
            initImageUpload(document.getElementsByClassName('image-box')[0])
        </script>
<?*/
    }
}
