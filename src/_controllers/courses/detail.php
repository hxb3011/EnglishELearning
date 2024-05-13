<?
session_start();
require_once "/var/www/html/_lib/utils/requir.php";
requirl("oopControllers/courses.php");
$ctrl = new Courses();
if (isset($_REQUEST['courseId'])) {
    $ctrl->detail($_REQUEST['courseId']);
}
else {
    header('Location: /error');
}
?>