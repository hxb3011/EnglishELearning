<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("utils/htmlDocument.php");
class AddWordPage extends BaseHTMLDocumentPage
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
                        Thêm từ vựng
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
                                            Thêm từ mới
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
                                    <form class="" action="/administration/dictionary/add.php" id="form_add_word" method="post" enctype="multipart/form-data"  autocomplete="off">
                                            <div class="tab-content b-0 mb-0 ">
                                                <div class="tab-pane active" role="tabpanel" aria-labelledby="nav_basic" id="basic">
                                                    <div class="row justify-content-center">
                                                        <div class="col-xl-8">
                                                            <h5 class="fw-bold">Word:</h5> 
                                                            <div class="form-group row mb-3 ">
                                                                <label class="col-md-3 col-form-label  w-25" for="lemmaKey">Key<span class="required">*</span> </label>
                                                                <input type="text" class="form-control  w-25" id="lemmaKey" name="lemmaKey" placeholder="Nhập từ mới" value="">

                                                                <label class="col-md-2 col-form-label w-25" for="partOfSpeech">Loại từ<span class="required">*</span> </label>
                                                                <select class="form-select form-select-md mb-3 w-25" name="partOfSpeech" id="partOfSpeech">
                                                                        <option value="Verb" > Verb</option>
                                                                        <option value="Noun" selected="true"> Noun</option>
                                                                        <option value="Adjective"> Adjective</option>
                                                                        <option value="Adverb"> Adverb</option>
                                                                    </select>
                                                            </div>

                                                            <h5 class="fw-bold">Pronunciation:</h5> 
                                                            <div class="form-group row mb-3  d-flex justify-content-left">
                                                                    <label class="col-md-2 col-form-label w-25" for="region">United State's Accent<span class="required">*</span> </label>
                                                                    <input type="text" class="form-control w-25" id="IPA" name="IPAUS" placeholder="IPA" value="">
                                                                    
                                                                    <label class="col-md-2 col-form-label w-25" for="region">United Kingdom's Accent<span class="required">*</span> </label>                                                         
                                                                    <input type="text" class="form-control w-25" id="IPA" name="IPAUK" placeholder="IPA" value="">
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
                                                            
                                                            <div class="d-flex align-items-center justify-content-center">
                                                                <button type="submit" class="btn btn-outline-primary btn-rounded btn-icon" id="submit_add_course" >Xác nhận</button>
                                                            </div>
                                                        </div>
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
            autocomplete(document.getElementById("conjugation"),document.getElementById("infinitiveID"),"ajax_call_action.php?action=search");
            
            function checkKeyExist(value,element){
                let data = {
                    input: value
                }
                console.log("check");
                $.ajax({
                    url : "ajax_call_action.php?action=checkKeyExist",
                    data : data,
                    dataType: 'json',
                    success : function(response)
                    {
                        if(response.status==204)
                        {
                            return true;
                        }
                        else 
                        {
                            return false;
                        }
                    }
                });
                return false;
            }

            document.getElementById("form_add_word").addEventListener("submit", function(e){
                
                let data = {
                    input : document.getElementById("lemmaKey").value,
                };
                if(checkKeyExist(document.getElementById("lemmaKey").value,document.getElementById("form_add_word"))){
                    e.preventDefault();
                    toastr.error("Từ đã tồn tại", "Thêm từ vựng: ")
                    console.log(checkKeyExist(document.getElementById("lemmaKey").value,document.getElementById("form_add_word")));
                }
                else   
                    {e.currentTarget.submit();}
            })

            
            document.getElementById("partOfSpeech").addEventListener("change",function(e){
                if(!this.value.localeCompare("Verb")){
                    document.getElementById("conjugation_section").classList.remove("_closed");
                }else{
                    document.getElementById("conjugation_section").classList.add("_closed");
                }
            })
            $(document).ready(function() {
                // thêm summer note
                //thêm các validate rule cho form
                $("#form_add_word").validate({
                    ignore: [],
                    onchange: function(e){
                        $(e).valid()
                    },
                    errorPlacement: function() {},
                    invalidHandler: function() {
                        toastr.error("Vui lòng kiểm tra lại các trường dữ liệu", "Thêm từ vựng: ")
                    },
                    rules: {
                        lemmaKey: {
                            required: true,
                            minlength: 1,
                            lettersonly: true,
                        },
                        partOfSpeech: {
                            required: true,
                        },
                        IPA: {
                            required: true,
                            nonNumeric: true,
                            minlength: 2
                        },
                    },
                    messages: {
                        lemmaKey: {
                            required: "Vui lòng nhập từ",
                            minlength: "Vui lòng nhập từ hợp lệ",
                            keyExisted: "Từ này đã tồn tại Thêm từ khác đi: ",
                        },
                        partOfSpeech: {
                            required: "Vui lòng loại từ",
                            minlength: "Vui lòng nhập từ hợp lệ",
                        },
                        IPA: {
                            required: "Vui lòng nhập IPA",
                            minlength: "Vui lòng nhập từ hợp lệ",
                            nonNumeric: "IPA không hợp lệ"
                        },
                    },
                    submitHandler: function(form) {

                    },
                    errorPlacement: function(error, element) {
                        error.insertAfter(element); // Place error message after the input element
                    },

                })
                
                $.validator.addMethod("lettersonly", function(value, element) 
                {
                return this.optional(element) || /^[a-z]+$/i.test(value);
                }, "Chỉ nhập chữ và 1 từ"); 

            $.validator.addMethod("nonNumeric", function(value, element) {
                return this.optional(element) || /^[\D+]*$/.test(value);
            },"Only alphabatic characters allowed.");
            
            })
           


        </script>


<?
    }
}
