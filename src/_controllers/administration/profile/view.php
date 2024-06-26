<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("profile/permissionChecker.php");

$holder = getPermissionHolder();
$_REQUEST["uri"] = $_SERVER['REQUEST_URI'];
$reqm = &$_SERVER['REQUEST_METHOD'];
if (!isset($reqm) && strtolower($reqm) !== "get") {
    http_response_code(404);
    $_REQUEST["ersp"] = "404";
    requira("_error.php");
} else {
    $granted = false;
    if (isset($holder)) {
        if (isAllPermissionsGranted(array(Permission_SystemPrivilege, Permission_ProfileManage, Permission_ProfileRead), $holder)) {
            $profileid = &$_REQUEST["profileid"];
            if (isset($profileid)) {
                requirv("admin/profile/ViewProfilePage.php");
                global $page;
                $profile = null;
                $profile = ProfileDAO::getProfileById($profileid);
                $page = new ViewProfilePage($profile);
                requira("_adminLayout.php");
                $granted = true;
            }
        }
    }
    if (!$granted) {
        http_response_code(403);
        $_REQUEST["ersp"] = "403";
        requira("_error.php");
    }
}
?>