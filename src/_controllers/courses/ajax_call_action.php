<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("oopControllers/courses.php");
$action = $_REQUEST['action'];
$ctrl = new Courses();
if(isset($action) && method_exists($ctrl,$action))
{
    call_user_func(array($ctrl,$action));
}else{
}