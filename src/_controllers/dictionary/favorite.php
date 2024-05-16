<?
if (!session_id())
session_start();
require_once "/var/www/html/_lib/utils/requir.php";
requirl("oopControllers/dictionary.php");
requirl("profile/permissionChecker.php");
requirm("dao/profile/profile.php");

$ctrl = new Dictionary();
$profile = getPermissionHolder();

if(isset($profile) && $profile instanceof Profile )
{
    $ctrl->favorite($profile->getId());
}else{
    $ctrl->favorite(null);
}