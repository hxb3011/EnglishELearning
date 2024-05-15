<?
if (!session_id())
    session_start();
require_once "/var/www/html/_lib/utils/requir.php";
requirl("oopControllers/courses.php");
requirm("dao/profile/profile.php");
requirl("profile/permissionChecker.php");

$holder = getPermissionHolder();

if (isset($holder)) {
    if ($holder instanceof Profile) {
        $ctrl = new Courses();
        if (isset($_REQUEST['courseId'])) {
            $profileID = ProfileDAO::getProfileByUid($_SESSION["AUTH_UID"])->getId();
            if ($ctrl->isRegisteredToCourse($profileID, $_REQUEST['courseId']))
                $ctrl->learn($profileID, $_REQUEST["courseId"]);
            else {
                // chuyển hướng sang mua khóa học
                $_SESSION['profileID'] = $profileID;
                $_SESSION['courseID'] = $_REQUEST['courseId'];
                header('Location: /courses/checkout.php');
            }
        } else {
            http_response_code(404);
            $_REQUEST["ersp"] = "404";
            requira("_error.php");
        }
    } else {
        http_response_code(403);
        $_REQUEST["ersp"] = "403";
        requira("_error.php");
    }
} else {
    $uri = urlencode('/courses/learn.php?courseId=' . $_REQUEST['courseId']);
    header('Location: /authentication/authenticate.php?uri='.$uri);
}

