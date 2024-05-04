<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("oopControllers/admin/courses.php");
$ctrl = new AdminCourses();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ctrl->edit_course();
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_REQUEST['courseId'])) {
        $ctrl->edit($_REQUEST['courseId']);
    } else {
        header('Location: /error');
    }
}
