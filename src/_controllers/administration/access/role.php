<?
require_once "/var/www/html/_lib/utils/requir.php";
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
        $key = $holder->getKey();
        if ($key->isPermissionGranted(Permission_SystemPrivilege) && $key->isPermissionGranted(Permission_RoleManager)) {
            if ($key->isPermissionGranted(Permission_RoleRead)) {
                requirv("admin/access/RoleMainPage.php");
                global $page;
                $instructorRole = RoleDAO::getDefaultRoleForInstructor();
                $learnerRole = RoleDAO::getDefaultRoleForLearner();
                $roles = RoleDAO::getRoleFromPage(1);
                $page = new RoleMainPage($holder, $roles, $instructorRole, $learnerRole);
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