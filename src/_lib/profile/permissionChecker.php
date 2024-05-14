<?
require_once "/var/www/html/_lib/utils/requir.php";
requirm("dao/profile/profile.php");

function getPermissionHolder(): ?IPermissionHolder {
    // if (!session_id())
    //     session_start();
    $authUID = &$_SESSION["AUTH_UID"];
    if (isset($authUID) && is_string($authUID)) {
        $holder = ProfileDAO::getProfileByUid($authUID);
        if (isset($holder))
            return $holder;
        $holder = AccountDAO::getAccountByUid($authUID);
        if (isset($holder))
            return $holder;
    }

    return null;
}
function isSignedIn() {
    return getPermissionHolder() !== null;
}
function isPermissionGrantedToGuest(int $permission): bool {
    if ($permission === Permission_ProfileRead) return true;
    // TODO: add more...
    return false;
}
function isPermissionGranted(int $permission): bool {
    $holder = getPermissionHolder();
    if ($holder !== null) 
        return $holder->getKey()->isPermissionGranted($permission);
    
    return isPermissionGrantedToGuest($permission);
}
?>