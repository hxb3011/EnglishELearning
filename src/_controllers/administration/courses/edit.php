<?
if (!session_id())
    session_start();
require_once "/var/www/html/_lib/utils/requir.php";
requirl("oopControllers/admin/courses.php");
requirl("profile/permissionChecker.php");
if (isset($_SESSION['isTutorOfCourse'])) unset($_SESSION['isTutorOfCourse']);
$holder = getPermissionHolder();

$granted = false;
if (isset($holder)) {
    $ctrl = new AdminCourses();
    $courseId = (isset($_REQUEST['courseId'])) ? $_REQUEST['courseId'] :  $_POST['courseID'];
    if (
        isAllPermissionsGranted([Permission_SystemPrivilege, Permission_CourseManage, Permission_CourseUpdate], $holder)
        || (($holder instanceof Profile) && $ctrl->isTutor($holder->getId(), $courseId))
    ) {
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
