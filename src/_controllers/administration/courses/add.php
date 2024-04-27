<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("oopControllers/admin/courses.php");
requirm('/access/Course.php');
$ctrl = new AdminCourses();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ctrl->add_course();
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $ctrl->add();
}