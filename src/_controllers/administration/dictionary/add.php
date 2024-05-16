<?
if(!session_id())
session_start();

require_once "/var/www/html/_lib/utils/requir.php";
requirl("oopControllers/admin/dictionary.php");
requirl("profile/permissionChecker.php");
$holder = getPermissionHolder();
$granted = false;
if (isset($holder)) {
    if(isAllPermissionsGranted([Permission_SystemPrivilege,Permission_DictionaryManage,Permission_LemmaWrite,Permission_ConjugationWrite,Permission_ConjugationWrite,Permission_PronunciationWrite],$holder))
    {
        $ctrl = new AdminDictionary();
            $granted = true;
            if ($_SERVER['REQUEST_METHOD'] === 'POST'){
                $ctrl->addLemma();
            } 
            else if ($_SERVER['REQUEST_METHOD'] === 'GET') 
            {
                $ctrl->add();
            } else {
                // header('Location: /error');
            }
    }
}
if (!$granted) {
    http_response_code(403);
    $_REQUEST["ersp"] = "403";
    requira("_error.php");
}

