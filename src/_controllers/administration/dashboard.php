<?
require_once "/var/www/html/_lib/utils/requir.php";
requirv("admin/dashboard/MainDashboardPage.php");
global $page;
$page  = new MainDashboardPage();
requira('_adminLayout.php');