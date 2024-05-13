<?
session_start();
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
        elseif ($query_o === "changepassword")
            $mode = ProfilePageMode_ChangePassword;
        elseif ($query_o === "addverification")
            $mode = ProfilePageMode_AddVerification;
        elseif ($query_o === "deletephone")
            $mode = ProfilePageMode_DeletePhone;
        elseif ($query_o === "deleteemail")
            $mode = ProfilePageMode_DeleteEmail;
    }
    return $mode;
}

global $page;
$mode = getMode();
$page = new ProfileMainPage(getPermissionHolder(), $mode);
requira("_layout.php");
?>