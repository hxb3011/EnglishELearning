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
        global $fragment_roles;
        global $fragment_role_read;
        global $fragment_role_update;
        global $fragment_role_delete;
        if ($key->isPermissionGranted(Permission_SystemPrivilege) && $key->isPermissionGranted(Permission_RoleManager)) {
            $fragment_role_read = $key->isPermissionGranted(Permission_RoleRead);
            if ($fragment_role_read) {
                $fragment_role_update = $key->isPermissionGranted(Permission_RoleUpdate);
                $fragment_role_delete = $key->isPermissionGranted(Permission_RoleDelete);

                $data = json_decode(file_get_contents("php://input"), true);
                $page = &$data['page'];
                $name = &$data['name'];
                $fragment_roles = RoleDAO::getRoleFromPage(isset($page) ? intval($page) : 1, 5, isset($name) ? $name : null);
                requirv("admin/access/RoleItemFragment.php");
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