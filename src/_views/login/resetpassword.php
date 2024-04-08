<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("utils/htmlDocument.php");

final class ResetPasswordPage extends BaseHTMLDocumentPage
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
        <div class="container vh-lg-100 mt-sm-5 bg-soft d-flex justify-content-center align-items-center">
            <div class="row justify-content-center form-bg-image">
                <div class="col-12 d-flex align-items-center justify-content-center">
                    <div class="bg-white shadow border-0 rounded p-4 p-lg-5 w-100 fmxw-500">
                        <h1 class="h3 mb-4 text-center">Reset password</h1>
                        <form action="#">
                            <!-- Form -->
                            <div class="form-group mb-4">
                                <label for="password">Your Password</label>
                                <div class="input-group">
                                    <input type="password" placeholder="Password" class="form-control" id="password" required>
                                </div>
                            </div>
                            <!-- End of Form -->
                            <!-- Form -->
                            <div class="form-group mb-4">
                                <label for="confirm_password">Confirm Password</label>
                                <div class="input-group">
                                    <input type="password" placeholder="Confirm Password" class="form-control" id="confirm_password" required>
                                </div>
                            </div>
                            <!-- End of Form -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-success">Reset password</button>
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