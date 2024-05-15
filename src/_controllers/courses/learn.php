<?
if (!session_id())
session_start();
require_once "/var/www/html/_lib/utils/requir.php";
requirl("oopControllers/courses.php");
requirm("dao/profile/profile.php");
if (isset($_SESSION["AUTH_UID"])) {
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
        //header('Location: /error');
    }
} else {
    header('Location: /authentication/authenticate.php');
}
