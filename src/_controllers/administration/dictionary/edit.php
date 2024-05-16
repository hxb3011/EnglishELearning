
<?
if(!session_id())
session_start();

require_once "/var/www/html/_lib/utils/requir.php";
requirl("oopControllers/admin/dictionary.php");
requirl("profile/permissionChecker.php");
$holder = getPermissionHolder();
$_REQUEST["uri"] = $_SERVER['REQUEST_URI'];
$reqm = &$_SERVER['REQUEST_METHOD'];
if (!isset($reqm) || strtolower($reqm) !== "get") {
    http_response_code(404);
    $_REQUEST["ersp"] = "404";
    requira("_error.php");
} else {
    $granted = false;
    if (isset($holder)) {
        if(isAllPermissionsGranted([Permission_SystemPrivilege,Permission_DictionaryManage,Permission_LemmaRead,Permission_MeaningRead],$holder))
        {
            $ctrl = new AdminDictionary();
            $ctrl->edit();
                $granted = true;
                if ($_SERVER['REQUEST_METHOD'] === 'POST'){
                    $ctrl->editLemma();
                } elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
                    if (isset($_REQUEST['lemmaID'])) {
                        $ctrl->edit($_REQUEST['lemmaID']);
                    } else {
                        header('Location: /error');
                    }
                }
        }
    }
    if (!$granted) {
        http_response_code(403);
        $_REQUEST["ersp"] = "403";
        requira("_error.php");
    }
}
