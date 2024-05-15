<?
require_once "/var/www/html/_lib/utils/requir.php";
requirv("introduction/home.php");
global $page;
$page = new CoursesIntroductionHomePage();
requira("_layout.php");
?>