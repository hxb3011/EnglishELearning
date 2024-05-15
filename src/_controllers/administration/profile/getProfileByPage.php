<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("profile/permissionChecker.php");

$holder = getPermissionHolder();
$_REQUEST["uri"] = $_SERVER['REQUEST_URI'];
$reqm = &$_SERVER['REQUEST_METHOD'];
if (!isset($reqm) || strtolower($reqm) !== "post") {
    http_response_code(404);
    $_REQUEST["ersp"] = "404";
    requira("_error.php");
} else {
    $granted = false;
    if (isset($holder)) {
        $key = $holder->getKey();
        global $fragment_profiles;
        global $fragment_profile_read;
        global $fragment_profile_update;
        global $fragment_profile_delete;
        if ($key->isPermissionGranted(Permission_SystemPrivilege) && $key->isPermissionGranted(Permission_ProfileManage)) {
            $fragment_profile_read = $key->isPermissionGranted(Permission_ProfileRead);
            if ($fragment_profile_read) {
                $fragment_profile_update = $key->isPermissionGranted(Permission_ProfileUpdate);
                $fragment_profile_delete = $key->isPermissionGranted(Permission_ProfileDelete);

                $data = json_decode(file_get_contents("php://input"), true);
                $page = &$data['page'];
                $name = &$data['name'];
                $fragment_profiles = ProfileDAO::getProfileFromPage(isset($page) ? intval($page) : 1, 5, isset($name) ? $name : null);
                requirv("admin/profile/ProfileItemFragment.php");
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