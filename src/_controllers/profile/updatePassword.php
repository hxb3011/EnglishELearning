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
    $account = null;
    if ($holder instanceof Profile) {
        $account = $holder->getAccount();
    } elseif ($holder instanceof Account) {
        $account = $holder;
    }
    $result = null;
    if (isset($account)) {
        $password = &$_REQUEST["password"];
        $xpassword = &$_REQUEST["xpassword"];
        $zpassword = &$_REQUEST["zpassword"];
        if (isset($password) && $password === $account->password && isset($xpassword) && isset($zpassword) && $xpassword === $zpassword) {
            $length = strlen($zpassword);
            if ($length >= 8 && $length <= 255 && preg_match("@^\s+$@", $zpassword) !== 1) {
                if (preg_match("@[a-z]@", $zpassword) === 1 && preg_match("@[A-Z]@", $zpassword) && preg_match("@[0-9]@", $zpassword) && preg_match("@[^\w\s]@", $zpassword)) {
                    $account->password = $password;
                    $result = AccountDAO::updateAccount($account);
                }
            }
        }
    }
    if (!isset($result)) {
        http_response_code(403);
        $_REQUEST["ersp"] = "403";
        requira("_error.php");
    } else
        header("Location: /profile/index.php");
}
?>