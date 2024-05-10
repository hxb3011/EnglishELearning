<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("oopControllers/dictionary.php");
$crtl = new Dictionary();
$crtl->favorite();
?>