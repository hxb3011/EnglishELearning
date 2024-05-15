<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("profile/permissionChecker.php");
requirm("dao/properties.php");

$holder = getPermissionHolder();

$_REQUEST["uri"] = $_SERVER['REQUEST_URI'];
$reqm = &$_SERVER['REQUEST_METHOD'];
if (!isset($reqm) || strtolower($reqm) !== "post") {
    http_response_code(404);
    $_REQUEST["ersp"] = "404";
    requira("_error.php");
} elseif (!isset($holder)) {
    http_response_code(403);
    $_REQUEST["ersp"] = "403";
    requira("_error.php");
} else {
    $data = json_decode(file_get_contents("php://input"), true);
    $result = 0;
    if (is_array($data)) {
        $id = &$data["instructor"];
        if (isset($id) && RoleDAO::setDefaultRoleForInstructor($id)) {
            $result |= 2;
        }
        $id = &$data["learner"];
        if (isset($id) && RoleDAO::setDefaultRoleForLearner($id)) {
            $result |= 1;
        }
    }
    echo $result;
}
?>