<?
if (!session_id())
session_start();
require_once "/var/www/html/_lib/utils/requir.php";
requirl("oopControllers/checkout.php");
if (!isset($_SESSION["AUTH_UID"])) {
    header("Location: /authentication/authenticate.php");
    exit();
}else {
   $ctrl = new Checkout();
   $ctrl->confirm();
}
?>