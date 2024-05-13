<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("utils/htmlDocument.php");

final class ForgetPasswordPage extends BaseHTMLDocumentPage
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

        $this->style(
            "/clients/css/login/forgetpassword.css"
        );

        $this->script(
            "https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        );
        $this->script(
            "https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"
        );
        $this->script(
            "/clients/js/authenticate/forgotpassword.js"
        );
    }

    public function body()
    {
        ?>
        <!-- TODO: move to css -->
        <div class="container-fluid mt-5 d-flex justify-content-center align-items-center">
            <div class="row justify-content-center form-bg-image p-6">
                <div class="col-12 d-flex align-items-center justify-content-center">
                    <div class="signin-inner my-3 my-lg-0 bg-white shadow border-0 rounded p-4 p-lg-5 w-100 fmxw-500">
                        <h1 class="h3">Quên mật khẩu?</h1>
                        <p class="mb-4">Đừng lo! Hãy nhập vào email của bạn ,chúng tôi sẽ gửi mã cho bạn cập nhật lại mật khẩu!</p>
                        <!-- Form -->
                        <form id="form-forget-password" action="#" method="POST">
                            <div class="mb-4">
                                <div id="message" class="alert d-none"></div>
                                <label for="email">Email của bạn:</label>
                                <div class="input-group mt-3">
                                    <input type="email" class="form-control" id="email" placeholder="phong@edu.com" required autofocus>
                                </div>
                            </div>
                            <div class="d-grid">
                                <button type="submit" id="send-email-btn" class="btn btn-secondary">Gửi Email</button>
                            </div>
                        </form>
                        <!-- End of Form -->
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