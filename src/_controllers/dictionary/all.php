<?
if (!session_id())
session_start();
require_once "/var/www/html/_lib/utils/requir.php";
requirl("oopControllers/dictionary.php");
requirl("profile/permissionChecker.php");
requirm("dao/profile/profile.php");

$ctrl = new Dictionary();
$profile = getPermissionHolder();
if(isset($profile) && $profile instanceof Profile && isset($_REQUEST['dictionary_search']))
{
    $word = $_REQUEST['dictionary_search'];
    call_user_func(array($ctrl,"detail"),$profile->getId());
}
else
{
    $ctrl->dictionary();
}
?>