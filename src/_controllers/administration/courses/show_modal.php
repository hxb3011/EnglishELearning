<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("oopControllers/admin/courses.php");
$action = $_REQUEST['action'];
$ctrl = new AdminCourses();
if(isset($action) && method_exists($ctrl,$action))
{
    call_user_func(array($ctrl,$action));
}else{
    header('Location: /error');
}