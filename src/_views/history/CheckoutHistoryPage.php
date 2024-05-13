<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("utils/htmlDocument.php");

class CheckoutHistoryPage extends BaseHTMLDocumentPage
{
    public function __construct()
    {
        parent::__construct();
    }
    public function documentInfo(string $author, string $description, string $title)
    {
        parent::documentInfo($author, $description, "Quản lý - " . $title);
    }

    public function openGraphInfo(string $image, string $description, string $title)
    {
        parent::openGraphInfo($image, $description, "Quản lý - " . $title);
    }

    public function favIcon(string $ico = null, string $svg = null)
    {
        parent::favIcon("/assets/images/logo-icon.png", $svg);
    }
    public function head()
    {
        $this->styles(
            "/node_modules/bootstrap/dist/css/bootstrap.min.css",
            "/node_modules/summernote/dist/summernote-bs5.min.css",
            "/node_modules/toastr/build/toastr.css",
            "/clients/css/admin/main.css",
            "/clients/css/admin/addcourse.css"
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
                        Thêm khóa học
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

                                </div>
                            </div>
                            <div style="margin-top:24px; margin-bottom:24px;"></div>
                            <div class="row">
                                <div class="col-md-12">
                                    
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
            "/clients/admin/main.js",
        );
        ?>

<?
    }
}
