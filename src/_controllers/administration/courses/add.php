<?
if (!session_id())
    session_start();
require_once "/var/www/html/_lib/utils/requir.php";
requirl("oopControllers/admin/courses.php");
requirl("profile/permissionChecker.php");
$holder = getPermissionHolder();

$granted = false;
if (isset($holder)) {
    $key = $holder->getKey();
    if (isAllPermissionsGranted([Permission_SystemPrivilege, Permission_CourseManage, Permission_CourseCreate])) {
        $ctrl = new AdminCourses();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ctrl->add_course();
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
}
