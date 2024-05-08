<?
require_once "/var/www/html/_lib/utils/requir.php";
requirv("profile/ProfileMainPage.php");
requirl("profile/permissionChecker.php");

function getMode()
{
    $mode = ProfilePageMode_Normal;
    $query_o = &$_GET["o"];
    if (isset($query_o)) {
        $query_o = strtolower($query_o);
        if ($query_o === "updateprofile")
            $mode = ProfilePageMode_UpdateProfile;
        if ($query_o === "changepassword")
            $mode = ProfilePageMode_ChangePassword;
    }
    return $mode;
}

global $page;
$mode = getMode();
$page = new ProfileMainPage(getPermissionHolder(), $mode);
requira("_layout.php");
?>