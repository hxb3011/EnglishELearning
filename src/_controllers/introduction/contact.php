<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("oopControllers/introduction.php");
$ctrl = new Introduction();
$ctrl->contact();
?>