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
            "/clients/css/admin/addcourse.css",
            "/clients/css/admin/autocomplete.css"
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
                                    <form class="" action="/administration/dictionary/dictionary.php" id="form_edit_course" method="post" enctype="multipart/form-data">
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
                                                                
                                                                <select class="form-select form-select-md mb-3 w-25" name="partOfSpeech" id="partOfSpeech">
                                                                        <option value="Verb" <? if(strcasecmp($this->lemma->partOfSpeech,"verb") == 0)  echo 'selected="true"';  ?> > Verb</option>
                                                                        <option value="Noun" <? if(strcasecmp($this->lemma->partOfSpeech,"noun") == 0)  echo 'selected="true"';  ?>> Noun</option>
                                                                        <option value="Adjective" <? if(strcasecmp($this->lemma->partOfSpeech,"adjective") == 0)  echo 'selected="true"';  ?>> Adjective</option>
                                                                        <option value="Adverb" <? if(strcasecmp($this->lemma->partOfSpeech,"adverd") == 0)  echo 'selected="true"';  ?>> Adverb</option>
                                                                </select>
                                                            </div>

                                                            <h5 class="fw-bold">Pronunciation:</h5> 
                                                            <div class="form-group row mb-3  d-flex justify-content-left">
                                                                    <label class="col-md-2 col-form-label w-25" for="IPAUS">United State's Accent<span class="required">*</span> </label>
                                                                    <input type="text" class="form-control w-25" id="IPAUS" name="IPAUS" placeholder="IPA" value="<? echo $this->lemma->pronunciation_arr[0]->IPA  ?>"></input>
                                                                    
                                                                    <label class="col-md-2 col-form-label w-25" for="IPAUK">United Kingdom's Accent<span class="required">*</span> </label>                                                         
                                                                    <input type="text" class="form-control w-25" id="IPAUK" name="IPAUK" placeholder="IPA" value="<? echo $this->lemma->pronunciation_arr[1]->IPA  ?>"></input>
                                                            </div>  
                                                            <div class="form-group row mb-3 _closed" id="conjugation_section">
                                                                <h5 class="fw-bold">Conjugation:</h5> 
                                                                <label class="col-md-5 col-form-label" for="description">Description </label>
                                                                <div class="col-md-10 autocomplete">
                                                                    <textarea name="description" id="description" class="form-control" ></textarea>
                                                                    <label class="col-md-5 col-form-label" for="conjugation">Conjugation </label>
                                                                    <input type="text" class="form-control" name="conjugation" id="conjugation"></input>
                                                                    <input type="hidden" class="form-control" name="infinitiveID" id="infinitiveID"></input>
                                                                </div>
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
                                                            <a href="javascript::void(0)" class="btn btn-outline-primary btn-rounded btn-sm ml-1 me-4" onclick="showAjaxModal('http://localhost:62280/administration/dictionary/ajax_call_action.php?action=meaning_modal&lemmaID=<? echo $this->lemma->ID ?>','Thêm nghĩa')"><i class="mdi-b plus"></i> Thêm nghĩa</a>
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
                                                                                <? if(!is_null($meaning->example_arr)) : ?>
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
                                                                            <? endif ?>
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
            autocomplete(document.getElementById("conjugation"),document.getElementById("infinitiveID"),"ajax_call_action.php?action=search")
            document.getElementById("partOfSpeech").addEventListener("change",function(e){
                if(!this.value.localeCompare("Verb")){
                    document.getElementById("conjugation_section").classList.remove("_closed");
                }else{
                    document.getElementById("conjugation_section").classList.add("_closed");
                }
            })
            $(document).ready(function() {
            var currentFocus = -1;
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
                        lemmaKey: {
                            required: false,
                            minlength: 2
                        },
                        IPAUS: {
                            required: true,
                        },
                        IPAUK: {
                            required: true,
                        },
                    },
                    messages: {
                        lemmaKey: {
                            required: "Vui lòng nhập từ",
                            minlength: "Vui lòng nhập từ hợp lệ",
                        },
                        conjugation: {
                            required: "Vui lòng nhập kiểu chia động từ",
                        },
                        description: {
                            required: "",
                        }
                    },
                    errorPlacement: function(error, element) {
                        error.insertAfter(element); // Place error message after the input element
                    },
                    submitHandler: function(form) {
                        form.submit()
                    }
                });
                $.validator.addMethod("lettersonly", function(value, element) 
                {
                return this.optional(element) || /^[a-z," "]+$/i.test(value);
                }, "Letters and spaces only please"); 

                $('.on-hover-action').mouseenter(function() {
                    let id = this.id;
                    $('#widget-of-' + id).show()
                })

                $('.on-hover-action').mouseleave(function() {
                    let id = this.id;
                    $('#widget-of-' + id).hide()
                })
            });
            // initImageUpload(document.getElementsByClassName('image-box')[0])
        </script>
<?
    }
}
