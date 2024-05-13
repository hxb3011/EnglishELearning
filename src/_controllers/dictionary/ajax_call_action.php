<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("oopControllers/dictionary.php");
$action = $_REQUEST['action'];
$search_input = $_REQUEST['search_input'];
$ctrl = new Dictionary();
if(isset($action) && method_exists($ctrl,$action))
{
    if(strcmp($action,'search') == 0)
        call_user_func(array($ctrl,$action),$search_input);
}else{
}