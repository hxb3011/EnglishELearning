<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("oopControllers/admin/courses.php");
requirl("profile/permissionChecker.php");
$holder = getPermissionHolder();
$_REQUEST["uri"] = $_SERVER['REQUEST_URI'];
$reqm = &$_SERVER['REQUEST_METHOD'];
if (!isset($reqm) || strtolower($reqm) !== "get") {
    http_response_code(404);
    $_REQUEST["ersp"] = "404";
    requira("_error.php");
} else {
    $granted = false;
    if (isset($holder)) {
        $ctrl = new AdminCourses();
        $courseId = (isset($_REQUEST['courseId'])) ? $_REQUEST['courseId'] :  $_POST['courseID'];
        if (isAllPermissionsGranted([Permission_SystemPrivilege, Permission_CourseManage, Permission_CourseUpdate],$holder) 
        || (($holder instanceof Profile) && $ctrl->isTutor($holder->getId(),$courseId) )) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $ctrl->edit_course();
            } elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
                $ctrl->edit($_REQUEST['courseId']);
            }
            $granted = true;
        }
    }
    if (!$granted) {
        http_response_code(403);
        $_REQUEST["ersp"] = "403";
        requira("_error.php");
    }
}
