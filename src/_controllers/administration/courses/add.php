<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("oopControllers/admin/courses.php");

$ctrl = new AdminCourses();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach($_POST as $key => $value){
        
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $ctrl->add();
}