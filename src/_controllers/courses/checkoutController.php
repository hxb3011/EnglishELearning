<?
require_once "/var/www/html/_lib/utils/requir.php";
if (isset($_SESSION["AUTH_UID"])) {
    header("Location: /authentication/authenticate.php");
    exit();
}else {
    requirv("checkout.php");
    global $page;
    $page = new CheckoutPage();
    requira("_layout.php");
}
?>