<?
require_once "/var/www/html/_lib/utils/requir.php";

requirl("oopControllers/admin/blog.php");
requirl("profile/permissionChecker.php");

$holder = getPermissionHolder();
$granted = false;
$ctrl = new AdminBlog();
$ctrl->add_post($holder);

/*
if (isset($holder)) {
    $key = $holder->getKey();
    if (isAllPermissionsGranted([Permission_SystemPrivilege, Permission_CourseManage, Permission_CourseCreate])) {
        $ctrl = new AdminBlog();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ctrl->add_post();
        } elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $ctrl->add();
        }
        $granted = true;
    }
}

if (!$granted) {
    http_response_code(403);
    $_REQUEST["ersp"] = "403";
    requira("_error.php");
}*/
?>