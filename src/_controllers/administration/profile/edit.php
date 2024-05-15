<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("profile/permissionChecker.php");

$holder = getPermissionHolder();
$_REQUEST["uri"] = $_SERVER['REQUEST_URI'];
$reqm = &$_SERVER['REQUEST_METHOD'];
if (!isset($reqm)) {
    http_response_code(404);
    $_REQUEST["ersp"] = "404";
    requira("_error.php");
} else {
    $reqm = strtolower($reqm);
    if ($reqm === "get") {
        $granted = false;
        if (isset($holder)) {
            $key = $holder->getKey();
            if ($key->isPermissionGranted(Permission_SystemPrivilege) && $key->isPermissionGranted(Permission_ProfileManage)) {
                $add = &$_REQUEST["add"];
                if (isset($add)) {
                    if ($add === "0") {
                        if ($key->isPermissionGranted(Permission_ProfileUpdate)) {
                            $profileid = &$_REQUEST["profileid"];
                            if (isset($profileid)) {
                                requirv("admin/profile/EditProfilePage.php");
                                global $page;
                                $profile = null;
                                if ($key->isPermissionGranted(Permission_ProfileRead)) {
                                    $profile = ProfileDAO::getProfileById($profileid);
                                }
                                if (!isset($profile)) {
                                    $profile = new Profile($profileid);
                                }
                                $account = $profile->getAccount();
                                if (isset($account)) {
                                    $account = $account->getUid();
                                } else {
                                    $account = null;
                                }
                                $accounts = AccountDAO::getUnlinkedAccounts($account);
                                $roles = RoleDAO::getAllRoles();
                                $page = new EditProfilePage($holder, $profile, $accounts, $roles, false);
                                requira("_adminLayout.php");
                                $granted = true;
                            }
                        }
                    } elseif ($add === "1") {
                        if ($key->isPermissionGranted(Permission_ProfileCreate)) {
                            requirv("admin/profile/EditProfilePage.php");
                            global $page;
                            $profile = &$_REQUEST["profileid"];
                            if (!isset($profile))
                                $profile = ProfileDAO::findUnallocatedID();
                            $profile = new Profile($profile);
                            $accounts = AccountDAO::getUnlinkedAccounts(null);
                            $roles = RoleDAO::getAllRoles();
                            $page = new EditProfilePage($holder, $profile, $accounts, $roles, true);
                            requira("_adminLayout.php");
                            $granted = true;
                        }
                    }
                }
            }
        }
        if (!$granted) {
            http_response_code(403);
            $_REQUEST["ersp"] = "403";
            requira("_error.php");
        }
    } elseif ($reqm === "post") {
        $granted = false;
        if (isset($holder)) {
            $key = $holder->getKey();
            if ($key->isPermissionGranted(Permission_SystemPrivilege) && $key->isPermissionGranted(Permission_ProfileManage)) {
                $add = &$_REQUEST["add"];
                if (isset($add)) {
                    if ($add === "0") {
                        if ($key->isPermissionGranted(Permission_ProfileUpdate)) {
                            $breakpoint = 0;
                            $id = &$_REQUEST["profileid"];
                            $firstName = &$_REQUEST["firstName"];
                            $lastName = &$_REQUEST["lastName"];
                            $gender = &$_REQUEST["gender"];
                            $birthday = &$_REQUEST["birthday"];
                            $type = &$_REQUEST["profiletype"];
                            $account = &$_REQUEST["account"];
                            $role = &$_REQUEST["role"];
                            if (isset($id) && isset($firstName) && isset($lastName) && isset($gender) && isset($birthday) && isset($type) && isset($account) && isset($role)) {
                                $breakpoint = 1;
                                $gender = intval($gender);
                                if ($gender !== Gender_Female)
                                    $gender = Gender_Male;
                                $type = intval($type);
                                if ($type !== ProfileType_Instructor)
                                    $type = ProfileType_Learner;
                                $profile = new Profile($id, $firstName, $lastName, $gender, $birthday, $type, 0);
                                $key = $profile->getKey();
                                if ($key instanceof PermissionHolderKey) {
                                    $key->set(AccountDAO::getAccountByUid($account), RoleDAO::getRoleById($role));
                                }
                                if (ProfileDAO::updateProfile($profile)) {
                                    header('Location: /administration/profile/index.php');
                                    $breakpoint = 2;
                                } else {
                                    header('Location: /administration/profile/edit.php?add=' . $add . '&profileid=' . $id);
                                    $breakpoint = 3;
                                }
                                $granted = true;
                            }
                            // echo $breakpoint;
                        }
                    } elseif ($add === "1") {
                        if ($key->isPermissionGranted(Permission_ProfileCreate)) {
                            $id = &$_REQUEST["profileid"];
                            $firstName = &$_REQUEST["firstName"];
                            $lastName = &$_REQUEST["lastName"];
                            $gender = &$_REQUEST["gender"];
                            $birthday = &$_REQUEST["birthday"];
                            $type = &$_REQUEST["profiletype"];
                            $account = &$_REQUEST["account"];
                            $role = &$_REQUEST["role"];
                            if (isset($id) && isset($firstName) && isset($lastName) && isset($gender) && isset($birthday) && isset($type) && isset($account) && isset($role)) {
                                $gender = intval($gender);
                                if ($gender !== Gender_Female)
                                    $gender = Gender_Male;
                                $type = intval($type);
                                if ($type !== ProfileType_Instructor)
                                    $type = ProfileType_Learner;
                                $profile = new Profile($id, $firstName, $lastName, $gender, $birthday, $type, 0);
                                $key = $profile->getKey();
                                if ($key instanceof PermissionHolderKey) {
                                    $key->set(AccountDAO::getAccountByUid($account), RoleDAO::getRoleById($role));
                                }
                                if (ProfileDAO::createProfile($profile)) {
                                    header('Location: /administration/profile/index.php');
                                } else {
                                    header('Location: /administration/profile/edit.php?add=' . $add . '&profileid=' . $id);
                                }
                                $granted = true;
                            }
                        }
                    }
                }
            }
        }
        if (!$granted) {
            http_response_code(403);
            $_REQUEST["ersp"] = "403";
            requira("_error.php");
        }
    } else {
        http_response_code(404);
        $_REQUEST["ersp"] = "404";
        requira("_error.php");
    }
}
?>