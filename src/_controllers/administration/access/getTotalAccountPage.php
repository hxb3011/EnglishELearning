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
        global $fragment_total_pages;
        global $fragment_current_page;
        if ($key->isPermissionGranted(Permission_SystemPrivilege) && $key->isPermissionGranted(Permission_AccountManage)) {
            if ($key->isPermissionGranted(Permission_AccountRead)) {
                $data = json_decode(file_get_contents("php://input"), true);
                $name = &$data['name'];
                $page = &$data['page'];
                $fragment_total_pages = ceil(AccountDAO::getTotalAccounts(isset($name) ? $name : null) / 5);
                $fragment_current_page = floatval(isset($page) ? $page : 1.0);
                requirv("admin/access/AccountPaginationFragment.php");
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