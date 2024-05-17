<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("utils/htmlDocument.php");

final class CodeVerifyPage extends BaseHTMLDocumentPage
{
    public function __construct()
    {
        parent::__construct(NAV_PROF);
    }

    // public function beforeDocument()
    // {
    //     parent::beforeDocument();
    // }

    public function documentInfo(string $author, string $description, string $title)
    {
        parent::documentInfo($author, $description, "Hồ sơ - " . $title);
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
        $this->style(
            "https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css",
            "sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
        );
        // $this->styles(

        // );
        // $this->scripts(

        // );
    }

    public function body()
    {
        ?>
        <style>
            body {
                background-color: burlywood;
            }
        </style>
        <div class="container vh-lg-100 mt-sm-5 d-flex justify-content-center align-items-center">
            <div class="row justify-content-center form-bg-image">
                <div class="col-12 d-flex align-items-center justify-content-center">
                    <div class="signin-inner my-3 my-lg-0 bg-white shadow border-0 rounded p-4 p-lg-5 w-100 fmxw-500">
                        <h1 class="h3">Code Verification</h1>
                        <p class="mb-4 message"></p>
                        <form action="#">
                            <!-- Form -->
                            <div class="mb-4">
                                <div class="input-group mt-3">
                                    <input type="text" class="form-control" id="code" placeholder="Enter Code" required autofocus>
                                </div>
                            </div>
                            <!-- End of Form -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-success">Gửi</button>
                            </div>
                        </form>
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