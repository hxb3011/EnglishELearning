<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("oopControllers/dictionary.php");
requirl("profile/permissionChecker.php");
requirm("dao/profile/profile.php");

$action = $_REQUEST['action'];
$profile = getPermissionHolder();

$ctrl = new Dictionary();
if(isset($action) && method_exists($ctrl,$action))
{
    if(isset($profile) && $profile instanceof Profile && strcasecmp($action,"update_favorite"))
        call_user_func(array($ctrl,$action),$profile->getId());
    else{
        call_user_func(array($ctrl,$action),$profile->getId());
    }
}else{
    call_user_func(array($ctrl,$action));
}