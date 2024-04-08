<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("oopControllers/authentication.php");
$ctrl = new Authentication();
$ctrl->forgetpassword();
?>