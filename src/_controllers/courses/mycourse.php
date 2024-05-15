<?
if (!session_id())
session_start();
require_once "/var/www/html/_lib/utils/requir.php";
requirl("oopControllers/courses.php");
requirl("profile/permissionChecker.php");
requirm("dao/profile/profile.php");

$ctrl = new Courses();
$profile = getPermissionHolder();

if(isset($profile) && $profile instanceof Profile )
{
    $ctrl->my_course($profile);
}else{
    $ctrl->my_course(null);
}