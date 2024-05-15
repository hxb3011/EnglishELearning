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
if (!isset($reqm) || strtolower($reqm) !== "get") {
    http_response_code(404);
    $_REQUEST["ersp"] = "404";
    requira("_error.php");
} elseif (!isset($holder)) {
    http_response_code(403);
    $_REQUEST["ersp"] = "403";
    requira("_error.php");
} else {
    session_unset();
    header("Location: /profile/index.php");
}
?>