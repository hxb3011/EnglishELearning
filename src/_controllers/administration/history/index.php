<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("oopControllers/admin/history.php");
$ctrl = new History();
$ctrl->index();