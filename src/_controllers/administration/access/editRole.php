<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("profile/permissionChecker.php");

function loadPermissionsFromRequest(Role $role)
{
    $key = $role->getKey();
    for ($value = PermissionMinValue; $value <= PermissionMaxValue; ++$value) {
        $permkey = getPermissionKey($value);
        $permvalue = &$_REQUEST[$permkey];
        $permvalue = isset($permvalue) && intval($permvalue) === $value;
        $key->setPermissionGranted($value, $permvalue);
    }
}

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
            if ($key->isPermissionGranted(Permission_SystemPrivilege) && $key->isPermissionGranted(Permission_RoleManager)) {
                $add = &$_REQUEST["add"];
                if (isset($add)) {
                    if ($add === "0") {
                        if ($key->isPermissionGranted(Permission_RoleUpdate)) {
                            $roleid = &$_REQUEST["roleid"];
                            if (isset($roleid)) {
                                requirv("admin/access/EditRolePage.php");
                                global $page;
                                $role = null;
                                if ($key->isPermissionGranted(Permission_RoleRead)) {
                                    $role = RoleDAO::getRoleById($roleid);
                                }
                                if (!isset($role)) {
                                    $role = new Role($roleid);
                                }
                                $type = 2;
                                if (isset($role)) {
                                    $default = RoleDAO::getDefaultRoleForInstructor();
                                    if ($default->getId() === $roleid) {
                                        $type = ProfileType_Instructor;
                                    }
                                    $default = RoleDAO::getDefaultRoleForLearner();
                                    if ($default->getId() === $roleid) {
                                        $type = ProfileType_Learner;
                                    }
                                }
                                $page = new EditRolePage($holder, $role, $type, false);
                                requira("_adminLayout.php");
                                $granted = true;
                            }
                        }
                    } elseif ($add === "1") {
                        if ($key->isPermissionGranted(Permission_RoleCreate)) {
                            requirv("admin/access/EditRolePage.php");
                            global $page;
                            $role = &$_REQUEST["roleid"];
                            if (!isset($role))
                                $role = RoleDAO::findUnallocatedID();
                            $role = new Role($role);
                            $page = new EditRolePage($holder, $role, 2, true);
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
            if ($key->isPermissionGranted(Permission_SystemPrivilege) && $key->isPermissionGranted(Permission_RoleManager)) {
                $add = &$_REQUEST["add"];
                if (isset($add)) {
                    if ($add === "0") {
                        if ($key->isPermissionGranted(Permission_RoleUpdate)) {
                            $id = $_REQUEST["roleid"];
                            $name = $_REQUEST["name"];
                            if (isset($id) && isset($name)) {
                                $role = new Role($id, $name);
                                loadPermissionsFromRequest($role);
                                if (RoleDAO::updateRole($role)) {
                                    header('Location: /administration/access/role.php');
                                } else {
                                    header('Location: /administration/access/editRole.php?add=' . $add . '&roleid=' . $id);
                                }
                                $granted = true;
                            }
                            $defaultType = &$_REQUEST["defaulttype"];
                            if (isset($defaultType) && isset($role)) {
                                if ($defaultType === strval(ProfileType_Instructor)) {
                                    RoleDAO::setDefaultRoleForInstructor($role->getId());
                                } elseif ($defaultType === strval(ProfileType_Learner)) {
                                    RoleDAO::setDefaultRoleForInstructor($role->getId());
                                }
                            }
                        }
                    } elseif ($add === "1") {
                        if ($key->isPermissionGranted(Permission_RoleCreate)) {
                            $id = $_REQUEST["roleid"];
                            $name = $_REQUEST["name"];
                            if (isset($id) && isset($name)) {
                                $role = new Role($id, $name);
                                loadPermissionsFromRequest($role);
                                if (RoleDAO::createRole($role)) {
                                    header('Location: /administration/access/role.php');
                                } else {
                                    header('Location: /administration/access/editRole.php?add=' . $add . '&roleid=' . $id);
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