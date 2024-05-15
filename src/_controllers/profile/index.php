<?
session_start();
require_once "/var/www/html/_lib/utils/requir.php";
requirl("profile/permissionChecker.php");
requirm("dao/profile/verification.php");
requirv("profile/ProfileMainPage.php");

function getProfilePage(): ProfileMainPage
{
    $verifications = array();
    $holder = getPermissionHolder();
    if ($holder instanceof Profile) {
        $verifications = VerificationDAO::getAllVerificationsByProfileID($holder->getId());
    }

    $query_o = &$_GET["o"];
    if (isset($query_o)) {
        $query_o = strtolower($query_o);
        if ($query_o === "updateprofile") {
            requirv("profile/UpdateProfilePage.php");
            return new UpdateProfilePage($holder, $verifications);
        } elseif ($query_o === "changepassword") {
            requirv("profile/ChangePasswordProfilePage.php");
            return new ChangePasswordProfilePage($holder, $verifications);
        } elseif ($query_o === "addverification") {
            requirv("profile/AddVerificationProfilePage.php");
            return new AddVerificationProfilePage($holder, $verifications);
        } elseif ($query_o === "deletephone") {
            $deleteValue = &$_REQUEST["v"];
            if (!isset($deleteValue)) $deleteValue = "";
            requirv("profile/DeletePhoneProfilePage.php");
            return new DeletePhoneProfilePage($holder, $verifications, $deleteValue);
        } elseif ($query_o === "deleteemail") {
            $deleteValue = &$_REQUEST["v"];
            if (!isset($deleteValue)) $deleteValue = "";
            requirv("profile/DeleteEmailProfilePage.php");
            return new DeleteEmailProfilePage($holder, $verifications, $deleteValue);
        }
    }
    return new ProfileMainPage($holder, $verifications);
}

global $page;
$page = getProfilePage();
requira("_layout.php");
?>