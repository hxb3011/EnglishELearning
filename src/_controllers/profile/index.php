<?
require_once "/var/www/html/_lib/utils/requir.php";
requirv("profile/ProfileMainPage.php");
global $page;
$page = new ProfileMainPage();
requira("_layout.php");
?>