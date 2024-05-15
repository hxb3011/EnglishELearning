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
        $email = &$_REQUEST["email"];
        $phone = &$_REQUEST["phone"];
        if (isset($email)) {
            if (preg_match("@^0\d{9,10}$@", $email) === 1) {
                $v = new Verification($holder->getId(), "");
                $v->setEmail($email);
                $result = VerificationDAO::deleteVerification($v);
            }
        }
        if (isset($phone)) {
            if (strlen($phone) <= 254 && preg_match("@^[a-zA-Z0-9.! #$%&'*+\/=?^_`{|}~-]{6,}\@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$@", $phone) === 1) {
                $v = new Verification($holder->getId(), "");
                $v->setPhone($phone);
                $result = VerificationDAO::deleteVerification($v);
            }
        }
    }
    if (isset($result)) {
        http_response_code(403);
        $_REQUEST["ersp"] = "403";
        requira("_error.php");
    } else
        header("Location: /profile/index.php");
}
?>