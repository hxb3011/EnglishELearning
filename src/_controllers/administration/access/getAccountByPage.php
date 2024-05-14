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
        global $fragment_accounts;
        global $fragment_account_read;
        global $fragment_account_update;
        global $fragment_account_delete;
        if ($key->isPermissionGranted(Permission_SystemPrivilege) && $key->isPermissionGranted(Permission_AccountManage)) {
            $fragment_account_read = $key->isPermissionGranted(Permission_AccountRead);
            if ($fragment_account_read) {
                $fragment_account_update = $key->isPermissionGranted(Permission_AccountUpdate);
                $fragment_account_delete = $key->isPermissionGranted(Permission_AccountDelete);

                $data = json_decode(file_get_contents("php://input"), true);
                $page = &$data['page'];
                $name = &$data['name'];
                $fragment_accounts = AccountDAO::getAccountFromPage(isset($page) ? intval($page) : 1, 5, isset($name) ? $name : null);
                requirv("admin/access/AccountItemFragment.php");
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