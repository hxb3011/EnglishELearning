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
            if ($key->isPermissionGranted(Permission_SystemPrivilege) && $key->isPermissionGranted(Permission_AccountManage)) {
                $add = &$_REQUEST["add"];
                if (isset($add)) {
                    if ($add === "0") {
                        if ($key->isPermissionGranted(Permission_AccountUpdate)) {
                            $uid = &$_REQUEST["uid"];
                            if (isset($uid)) {
                                requirv("admin/access/EditAccountPage.php");
                                global $page;
                                $account = null;
                                if ($key->isPermissionGranted(Permission_AccountRead)) {
                                    $account = AccountDAO::getAccountByUid($uid);
                                }
                                if (!isset($account)) {
                                    $account = new Account($uid);
                                }
                                $page = new EditAccountPage($holder, $account, false);
                                requira("_adminLayout.php");
                                $granted = true;
                            }
                        }
                    } elseif ($add === "1") {
                        if ($key->isPermissionGranted(Permission_AccountCreate)) {
                            requirv("admin/access/EditAccountPage.php");
                            global $page;
                            $account = &$_REQUEST["uid"];
                            if (!isset($account))
                                $account = AccountDAO::findUnallocatedUID();
                            $account = new Account($account);
                            $page = new EditAccountPage($holder, $account, true);
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
            if ($key->isPermissionGranted(Permission_SystemPrivilege) && $key->isPermissionGranted(Permission_AccountManage)) {
                $add = &$_REQUEST["add"];
                if (isset($add)) {
                    if ($add === "0") {
                        if ($key->isPermissionGranted(Permission_AccountUpdate)) {
                            $id = $_REQUEST["uid"];
                            $userName = $_REQUEST["userName"];
                            $password = $_REQUEST["password"];
                            if (isset($id) && isset($userName) && isset($password)) {
                                $account = new Account($id, $userName, $password);
                                if (AccountDAO::updateAccount($account)) {
                                    header('Location: /administration/access/account.php');
                                } else {
                                    header('Location: /administration/access/editAccount.php?add=' . $add . '&uid=' . $id);
                                }
                                $granted = true;
                            }
                        }
                    } elseif ($add === "1") {
                        if ($key->isPermissionGranted(Permission_AccountCreate)) {
                            $id = $_REQUEST["uid"];
                            $userName = $_REQUEST["userName"];
                            $password = $_REQUEST["password"];
                            if (isset($id) && isset($userName) && isset($password)) {
                                $account = new Account($id, $userName, $password);
                                if (AccountDAO::createAccount($account)) {
                                    header('Location: /administration/access/account.php');
                                } else {
                                    header('Location: /administration/access/editAccount.php?add=' . $add . '&uid=' . $id);
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