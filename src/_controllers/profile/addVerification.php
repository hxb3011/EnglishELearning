<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("profile/permissionChecker.php");
requirm("dao/profile/verification.php");

$holder = getPermissionHolder();
$_REQUEST["uri"] = $_SERVER['REQUEST_URI'];
$reqm = &$_SERVER['REQUEST_METHOD'];
if (!isset($reqm) || strtolower($reqm) !== "post") {
    http_response_code(404);
    $_REQUEST["ersp"] = "404";
    requira("_error.php");
} else {
    $result = null;
    if (isset($holder) && $holder instanceof Profile) {
        $type = &$_REQUEST["verificationtype"];
        $value = &$_REQUEST["value"];
        if ($type === "phone") {
            $v = new Verification($holder->getId(), "");
            $v->setPhone($value);
            $result = VerificationDAO::createVerification($v);
        } elseif ($type === "email") {
            $v = new Verification($holder->getId(), "");
            $v->setEmail($value);
            $result = VerificationDAO::createVerification($v);
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