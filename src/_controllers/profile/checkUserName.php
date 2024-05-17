<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("profile/permissionChecker.php");
requirl("utils/htmlDocument.php");

$account = null;
$holder = getPermissionHolder();
if ($holder instanceof Account) {
    $account = $holder;
} elseif ($holder instanceof Profile) {
    $account = $holder->getAccount();
}

global $activeNavGetError;
$activeNavGetError = NAV_PROF;

$_REQUEST["uri"] = $_SERVER['REQUEST_URI'];
$reqm = &$_SERVER['REQUEST_METHOD'];
if (!isset($reqm) || strtolower($reqm) !== "post") {
    http_response_code(404);
    $_REQUEST["ersp"] = "404";
    requira("_error.php");
} else {
    $uid = &$_REQUEST["uid"];
    $testUserName = &$_REQUEST["userName"];
    if (isset($uid)) {
        $targetAccount = AccountDAO::getAccountByUid($uid);
        if (isset($targetAccount)) $account = $targetAccount;
    }
    if (!isset($account)) {
        http_response_code(403);
        $_REQUEST["ersp"] = "403";
        requira("_error.php");
    } else {
        $result = 1;
        if (isset($testUserName)) {
            $currentUserName = $account->userName;
            if ($testUserName == $currentUserName || !AccountDAO::isUserNameExist($testUserName)) {
                $result = 0;
            }
        }
        echo $result;
    }
}
