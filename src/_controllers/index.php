<?
session_start();
$_SESSION['AUTH_UID'] = '2';
require_once "/var/www/html/_lib/utils/requir.php";
requirc("profile/index.php");
?>