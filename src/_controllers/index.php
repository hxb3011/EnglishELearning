<?
//session_start();
require_once "/var/www/html/_lib/utils/requir.php";
if (!session_id())
    session_start();
$_SESSION["AUTH_UID"] = "6640ce125abbd";
requirc("profile/index.php");
?>