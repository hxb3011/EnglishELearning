<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("oopControllers/admin/dictionary.php");
$ctrl = new AdminDictionary();
$ctrl->index();