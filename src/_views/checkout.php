<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("utils/htmlDocument.php");

final class CheckoutPage extends BaseHTMLDocumentPage
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
            "/clients/css/checkout/checkout.css"
        );
        $this->script(
            "https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js",
        );
        $this->scripts(
            "https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js",
            "https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js",
            "https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        );
    }
    public function body()
    {
        ?>
            <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col">
                        <h1 class="text-start mb-5">Checkout</h1>
                        <div class="card mb-4">
                            <div class="card-body p-4">
                                <div class="row align-items-center">
                                    <div class="col-md-2">
                                        <div class="d-flex justify-content-center">
                                            <img src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/E-commerce/Products/1.webp" class="img-fluid" alt="Generic placeholder image">
                                        </div>
                                    </div>
                                    <div class="col-md-2 text-center">
                                            <p>Name</p>
                                            <p class="course-name">iPad Air</p>
                                    </div>
                                    <div class="col-md-2 text-center">
                                            <p>Quantity</p>
                                            <p class="quantity">1</p>
                                    </div>
                                    <div class="col-md-2 text-center">
                                            <p>Price</p>
                                            <p class="price">$799</p>
                                    </div>
                                    <div class="col-md-2 text-center">
                                            <p>Total</p>
                                            <p class="total_price">$799</p>
                                    </div>
                                    <div class="col-md-2 text-center">
                                            <p>Create At</p>
                                            <p class="creat_at">05/06/2024 23:59:34</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-5">
                            <div class="card-body p-4">
                                <div class="float-end order-total">
                                    <span class="text-white me-2">Order total:</span> 
                                    <span class="text-white lead fw-normal total">$799</span>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end input-group">
                            <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-light btn-lg me-2">Continue shopping</button>
                            <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg">Add to cart</button>
                        </div>

                    </div>
                </div>
            </div>
        <?
    }
}
?>