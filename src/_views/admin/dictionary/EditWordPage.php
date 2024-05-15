<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("utils/htmlDocument.php");
class EditWordPage extends BaseHTMLDocumentPage
{   
    public Lemma $lemma;
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
        parent::documentInfo($author, $description, "Từ điển- " . $title);
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
                        Sửa từ vựng
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
                                            Cập nhật từ vựng
                                        </span>
                                        <a type="button" href="/administration/dictionary/dictionary.php" class="btn btn-outline-primary btn-rounded btn-icon">
                                            <i class="mdi-b back"></i> Quản lý từ điển
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div style="margin-top:24px; margin-bottom:24px;"></div>
                            <div class="row">
                                <div class="col-md-12">
                                    <form class="" action="/administration/dictionary/edit.php" id="form_edit_course" method="post" enctype="multipart/form-data">
                                        <div class="basicwizard">
                                            <ul class="nav nav-pills nav-justified form-wizard-header">
                                                <li class="nav-item">
                                                    <a id="nav_basic" class="nav-link rounded-0 pt-2 pb-2 active" data-bs-toggle="tab" href="#basic">
                                                        <i class="mdi-b fountain-pen"></i>
                                                        <span class="d-none d-sm-inline">Cơ bản</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link rounded-0 pt-2 pb-2" data-bs-toggle="tab" href="#meaning">
                                                        <i class="mdi-b camera-control"></i>
                                                        <span class="d-none d-sm-inline">Nghĩa</span>
                                                    </a>
                                                </li>
                                            </ul>
                                            <div class="tab-content b-0 mb-0 mt-4">
                                                <div class="tab-pane active" role="tabpanel" aria-labelledby="nav_basic" id="basic">
                                                    <div class="row justify-content-center">
                                                        <div class="col-xl-8">
                                                            <input type="hidden" name="lemmaID" value="<? echo $this->lemma->ID;?>">
                                                            <h5 class="fw-bold">Word:</h5> 
                                                            <div class="form-group row mb-3 ">
                                                                <label class="col-md-3 col-form-label  w-25" for="lemmaKey">Key<span class="required">*</span> </label>
                                                                <input type="text" class="form-control text-capitalize w-25" id="lemmaKey" value="<? echo $this->lemma->keyL ?>" name="lemmaKey">

                                                                <label class="col-md-2 col-form-label w-25" for="partOfSpeech">Loại từ<span class="required">*</span> </label>
                                                                <input type="text" class="form-control text-capitalize w-25" id="partOfSpeech" name="partOfSpeech" value="<? echo $this->lemma->partOfSpeech ?>"  placeholder="Nhập từ loại" >
                                                            </div>

                                                            <h5 class="fw-bold">Pronunciation:</h5> 
                                                            <? foreach(($this->lemma->pronunciation_arr) as $pronunciation) :?>
                                                                <div class="form-group row mb-3  d-flex justify-content-between">
                                                                    <label class="col-md-2 col-form-label w-25" for="region">Kiểu giọng </label>
                                                                    <input type="text" disabled class="form-control w-25" id="region" name="region" value="<? echo $pronunciation->region ?>" >
                                                                    
                                                                    <label class="col-md-2 col-form-label w-25" for="IPA">IPA phát âm<span class="required">*</span> </label>
                                                                    <input type="text" class="form-control w-25" id="IPA" name="IPA<?echo $pronunciation->region?>" placeholder="Phát âm" value="<? echo $pronunciation->IPA ?>">
                                                                </div>
                                                            <? endforeach ?>       
                                                            <div class="form-group row mb-3">
                                                                <h5 class="fw-bold">Conjugation (optional):</h5> 
                                                                <label class="col-md-5 col-form-label" for="description">Description </label>
                                                                <div class="col-md-10">
                                                                    <textarea name="description" id="description" class="form-control" ></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row mb-3 autocomplete">
                                                                <label class="col-md-5 col-form-label" for="conjugation">Conjugation </label>
                                                                <input type="text" class="form-control" name="conjugation" id="conjugation"></input>
                                                                <input type="hidden" class="form-control" name="infinitiveID" id="infinitiveID"></input>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex align-items-center justify-content-center">
                                                            <button type="submit" class="btn btn-outline-primary btn-rounded btn-icon" id="submit_add_course" >Xác nhận</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane " id="meaning" role="tabpanel" aria-labelledby="meaning">
                                                    <div class="row ">
                                                        <div class="col-md-12 mt-4 mb-4 d-flex justify-content-center">
                                                            <a href="javascript::void(0)" class="btn btn-outline-primary btn-rounded btn-sm ml-1 me-4" onclick="showAjaxModal('http://localhost:62280/administration/dictionary/show_modal.php?action=meaning_modal','Thêm nghĩa')"><i class="mdi-b plus"></i> Thêm nghĩa</a>
                                                        </div>
                                                    </div>
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="d-flex align-items-center justify-content-end mb-2">
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <? foreach (($this->lemma->meaning_arr) as $meaning) : ?>
                                                                <? if ($meaning instanceof Meaning) : ?>
                                                                    <div class="col-12 mt-4">
                                                                        <div class="card bg-light  ps-4 pe-4n " id="<? echo ($meaning->ID) ?>">
                                                                            <div class="card-body">
                                                                                <div class="d-flex justify-content-start align-items-center">
                                                                                    <div class="card-title fw-200 text-capitalize w-25">
                                                                                        <? echo '<strong>'.($meaning->meaning) .'</strong>'; ?>
                                                                                    </div>
                                                                                    <div class="card-title ">
                                                                                        <? echo ($meaning->explanation); ?>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="card-widget d-flex justify-content-between" id="<? echo ("widget-of-" . $meaning->ID) ?>" >
                                                                                    <span><a href="javascript::void(0)" class="btn btn-outline-primary btn-rounded btn-sm ml-1" onclick="showAjaxModal('http://localhost:62280/administration/dictionary/ajax_call_action.php?action=meaning_modal&editmode=1&meaningID=<? echo ($meaning->ID); ?>', 'Sửa nghĩa')"><i class="mdi-b pen"></i> Sửa nghĩa</a>
                                                                                    <a href="javascript::void(0)" class="btn btn-outline-primary btn-rounded btn-sm ml-1" onclick="confirm_delete_modal('http://localhost:62280/administration/dictionary/ajax_call_action.php?action=delete_meaning&meaningID=<? echo ($meaning->ID); ?>','Xóa nghĩa','Bạn có chắc muốn xóa nghĩa này')"><i class="mdi-b delete"></i> Xóa nghĩa</a>
                                                                                    </span><a href="javascript::void(0)" class="btn btn-outline-primary btn-rounded btn-sm ml-1" onclick="showAjaxModal('http://localhost:62280/administration/dictionary/ajax_call_action.php?action=example_modal&meaningID=<? echo ($meaning->ID); ?>','Thêm ví dụ')"><i class="mdi-b plus"></i> Thêm ví dụ</a>
                                                                                </div>
                                                                                <? foreach (($meaning->example_arr) as $example) : ?>
                                                                                    <div class="program__lesson bg-white ps-3 pe-3 pt-3 pb-3 mt-3 rounded-1 d-flex justify-content-between align-items-center" style="box-shadow: 0 0 35px 0 rgba(154, 161, 171, .15);">
                                                                                    <h5 class="card-title mb-0">
                                                                                        <span class="font-weight-light">
                                                                                            
                                                                                            <? echo ($example->explanation) ?>
                                                                                        </span>
                                                                                    </h5>
                                                                                    <div class="card-widget">
                                                                                        <a class="" onclick="showAjaxModal('http://localhost:62280/administration/dictionary/ajax_call_action.php?action=example_modal&editmode=1&meaningID=<?echo($meaning->ID)?>&exampleID=<? echo ($example->ID) ?>','Sửa ví dụ')">
                                                                                            <i class="mdi-b pen"></i>
                                                                                        </a>
                                                                                        <a onclick="confirm_delete_modal('http://localhost:62280/administration/dictionary/ajax_call_action.php?action=delete_example&exampleId=<? echo ($example->ID) ?>','Xóa ví dụ','Bạn có chắc muốn xóa ví dụ này')">
                                                                                            <i class="mdi-b close"></i>
                                                                                        </a>
                                                                                    </div>
                                                                                </div>
                                                                            <? endforeach ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                <? endif?>
                                                            <? endforeach ?>
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
            "/clients/admin/main.js",
            "/clients/js/autocomplete.js",
        );
        ?>
        <script>
            var currentFocus = -1;
                autocomplete(document.getElementById("conjugation"),document.getElementById("infinitiveID"),"dictionary.php")
            $(document).ready(function() {
                // thêm summer note
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
            // initImageUpload(document.getElementsByClassName('image-box')[0])
        </script>
<?
    }
}
