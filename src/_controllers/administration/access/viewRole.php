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
    if (isAllPermissionsGranted(array(Permission_SystemPrivilege, Permission_RoleManager, Permission_RoleRead), $holder)) {
        $roleid = &$_REQUEST["roleid"];
        if (isset($roleid)) {
            requirv("admin/access/ViewRolePage.php");
            global $page;
            $role = RoleDAO::getRoleById($roleid);
            $page = new ViewRolePage($role);
            requira("_adminLayout.php");
            $granted = true;
        }
    }
    if (!$granted) {
        http_response_code(403);
        $_REQUEST["ersp"] = "403";
        requira("_error.php");
    }
}
?>