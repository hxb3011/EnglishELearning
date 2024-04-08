<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("oopControllers/blog.php");
$ctrl = new Blog();
$ctrl->all();
?>