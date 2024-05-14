<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("oopControllers/admin/blog.php");
$action = $_REQUEST['action'];
$ctrl = new AdminBlog();
if(isset($action) && method_exists($ctrl,$action))
{
    call_user_func(array($ctrl,$action));
}else{
}