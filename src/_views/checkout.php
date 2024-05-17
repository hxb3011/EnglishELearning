<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("utils/htmlDocument.php");

final class CheckoutPage extends BaseHTMLDocumentPage
{
    public Course $course;
    public Profile $profile;
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
        parent::documentInfo($author, $description, "Thanh toán - " . $title);
    }

    public function openGraphInfo(string $image, string $description, string $title)
    {
        parent::openGraphInfo($image, $description, "Thanh toán - " . $title);
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
            "/clients/css/checkout/checkout.css",
        );
        $this->styles(
            "/node_modules/toastr/build/toastr.css"
        );
        $this->script(
            "https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js",
        );
        $this->scripts(
            "https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js",
            "https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js",
            "https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js",
        );
        $this->script(
            "https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js",

        );
        $this->scripts(
            "/clients/js/checkout.js",
            "/node_modules/toastr/build/toastr.min.js",

        );
    }
    public function body()
    {
?>
        <style>
            .toast-title {
                font-size: 20rem;
            }

            .toast-message {
                font-size: 18rem;
            }
        </style>
        <div class="checkout-main">
            <div class="container">
                <div class="justify-content-between row">
                    <div class="checkout__left col-7">
                        <div class="row bg-white mb-4 p-4 rounded-3">
                            <h5 class="checkout-header">Phương thức thanh toán</h5>
                            <ul class="checkout-method row ps-4" style="row-gap: 16px;">

                                <li class="col-6">
                                    <div data-id="QR" class="checkout-address-btn flex-column select-payment-method">
                                        <div class="checkout-method-title">Thanh toán bằng mã QR</div>
                                        <div class="checkout-method-describe">ACB, BIDV, Techcombank, MBBank, VPBank, VietinBank, Agribank</div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="checkout__right col-4">
                        <div class="row bg-white mb-4 p-4 rounded-3">
                            <h5 class="checkout-header d-flex justify-content-between">
                                <div class="">Thông tin đơn hàng</div>
                                <a href="/introduction/index.php" class="edit-order align-self-center">Quay lại</a>
                            </h5>
                            <ul class="checkout__right-cart">

                            </ul>
                        </div>
                        <div class="checkout-confirm row bg-white mb-4 p-4 rounded-3">
                            <input type="hidden" name="profileID" id="profileID" value="<? echo ($this->profile->getId()) ?>">
                            <input type="hidden" name="courseID" id="courseID" value="<? echo ($this->course->id) ?>">
                            <div class="d-flex justify-content-between">
                                <div>Tên khóa học</div>
                                <span><? echo ($this->course->name) ?></span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div>Người đặt</div>
                                <span class="checkout-confirm__tmp-total"><? echo ($this->profile->firstName . ' ' . $this->profile->lastName) ?></span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div>Tổng tạm tính</div>
                                <span class="checkout-confirm__tmp-total"><? echo ($this->course->price) ?> VNĐ</span>
                            </div>

                            <div class="d-flex justify-content-between">
                                <div>Thành tiền</div>
                                <input type="hidden" name="price" id="price" value="<? echo ($this->course->price) ?>">
                                <span class="checkout-confirm__money-total" style="font-size: 20px; color: red;"><? echo ($this->course->name) ?></span>
                            </div>
                            <button class="btn btn-payment mt-4 mx-2" id="btn-payment">THANH TOÁN</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal-cart qr-code">
                <div class="modal-cart-dialog" style="min-width: 410px;">
                    <div class="modal-cart-body" style="min-height: 450px;">
                        <div id="img-qrcode" style="text-align: center; margin-top: 20px;">
                            <img style="width: 270px; " src="../assets/images/qrcode.jpg">
                        </div>
                        <div class="d-flex justify-content-center mt-3">
                            <h5 class="text">Mã QR thanh toán tự động</h5>
                        </div>
                        <div class="text d-flex justify-content-center">
                            <h6 class="text" style="font-size: 15px;">(Xác nhận tự động - Thường không quá 3')</h6>
                        </div>
                        <div class="d-flex justify-content-start">
                            <label>Số tiền: </label>
                            <span class="checkout-qrcode-price mx-2">VNĐ</span>
                        </div>
                        <div class="d-flex justify-content-start">
                            <label>Nội dung: </label>
                            <span class="checkout-qrcode-content mx-2">Miễn phí</span>
                        </div>
                        <div class="d-flex justify-content-start">
                            <label>Người thụ hưởng: </label>
                            <span class="checkout-qrcode-receiver mx-2">LE TAN MINH TOAN</span>
                        </div>
                        <hr style="color: white;">
                        <div class="d-flex justify-content-between mb-3">
                            <label>Đang chờ thanh toán</label>
                            <span id="checkout-qrcode-countdown" class="mx-2">10:00</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-cart qr-code-success">
                <div class="modal-cart-dialog" style="min-width: 410px; min-height: 40px;">
                    <div class="modal-cart-body">
                        <div class="d-flex justify-content-center mt-3">
                            <h5 class="text" style="font-size: 18rem;">THANH TOÁN THÀNH CÔNG</h5>
                        </div>
                        <hr style="color: white;">
                        <div class="d-flex justify-content-between mb-3">
                            <label>Bắt đầu sau</label>
                            <span id="checkout-qrcode-countdown2" class="mx-2"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?
    }
}
?>