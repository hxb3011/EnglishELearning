<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("oopControllers/admin/dictionary.php");
$action = $_REQUEST['action'];
$ctrl = new AdminDictionary();
if(isset($action) && method_exists($ctrl,$action))
{   
    call_user_func(array($ctrl,$action));

}else{
}

