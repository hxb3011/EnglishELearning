<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("oopControllers/admin/courses.php");
$ctrl = new AdminCourses();
if(isset($_REQUEST['courseId']))
{
    $ctrl->edit($_REQUEST['courseId']);

}else{
    header('location: /error');
}
