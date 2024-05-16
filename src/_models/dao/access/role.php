<?
require_once "/var/www/html/_lib/utils/requir.php";
requirm('/dao/database.php');
requirm('/dao/properties.php');
requirm('/access/permission.php');
requirl('/profile/preload.php');

final class RoleDAO
{
    public static function getTotalRoles(?string $name = null)
    {
        if (isset($name)) {
            $likeNameWhereClause = " WHERE `role`.`Name` LIKE CONCAT('%', ?, '%')";
            $params = array($name);
        } else {
            $likeNameWhereClause = "";
            $params = null;
        }
        $sql = "SELECT COUNT(*) AS total_roles FROM `role`";
        $sql .= $likeNameWhereClause;
        $result = Database::executeQuery($sql, $params);
        if (!isset($result) || count($result) === 0)
            return floatval(0);
        return floatval($result[0]['total_roles']);
    }
    public static function getRoleFromPage(int $page = 1, int $perPage = 5, ?string $name = null)
    {
        $offSet = ($page - 1) * $perPage;
        if (isset($name)) {
            $likeNameWhereClause = " WHERE `role`.`Name` LIKE CONCAT('%', ?, '%')";
            $params = array($name);
        } else {
            $likeNameWhereClause = "";
            $params = null;
        }
        $sql = "SELECT * FROM `role`";
        $sql .= $likeNameWhereClause;
        $sql .= " ORDER BY `role`.`Name` ASC LIMIT $offSet, $perPage";
        $result = Database::executeQuery($sql, $params);

        $roles = array();
        if ($result === null || count($result) === 0)
            return $roles;

        foreach ($result as $key => $value) {
            $role = new Role($value["ID"], $value["Name"]);
            PermissionHolderKey::loadPermissions($role, $value["Permissions"]);
            array_push($roles, $role);
        }
        return $roles;
    }

    public static function getAllRoles()
    {
        $sql = "SELECT * FROM `role` ORDER BY `role`.`Name` ASC";
        $result = Database::executeQuery($sql);
        $roles = array();
        if ($result === null || count($result) === 0)
            return $roles;

        foreach ($result as $key => $value) {
            $role = new Role($value["ID"], $value["Name"]);
            PermissionHolderKey::loadPermissions($role, $value["Permissions"]);
            array_push($roles, $role);
        }
        return $roles;
    }
    public static function getRoleById(string $id)
    {
        $sql = "SELECT * FROM `role` WHERE ID = ?";
        $result = Database::executeQuery($sql, array($id));
        if ($result === null || count($result) === 0)
            return null;

        $value = $result[0];
        $role = new Role($value["ID"], $value["Name"]);
        PermissionHolderKey::loadPermissions($role, $value["Permissions"]);
        return $role;
    }
    public static function findUnallocatedID()
    {
        $sql = "SELECT COUNT(*) AS RoleCount FROM `role` WHERE `role`.`ID` = ?";
        for ($i = 0; $i < 100; ++$i) {
            $id = uniqid(strval(0));
            $result = Database::executeQuery($sql, array($id));
            if (isset($result) && count($result) !== 0 && intval($result[0]["RoleCount"]) === 0) {
                return $id;
            }
        }
        return uniqid();
    }
    public static function createRole(Role $role)
    {
        if (!isset($role))
            return false;
        $sql = "INSERT INTO `role`(`ID`, `Name`, `Permissions`) VALUES (?, ?, ?)";
        $id = $role->getId();
        $name = $role->name;
        $permissions = PermissionHolderKey::savePermissions($role);
        return Database::executeNonQuery($sql, array($id, $name, $permissions));
    }
    public static function updateRole(Role $role)
    {
        if (!isset($role))
            return false;
        $sql = "UPDATE `role` SET `Name` = ?, `Permissions` = ? WHERE `ID` = ?";
        $id = $role->getId();
        $name = $role->name;
        $permissions = PermissionHolderKey::savePermissions($role);
        return Database::executeNonQuery($sql, array($name, $permissions, $id));
    }
    public static function getDefaultRoleForInstructor()
    {
        $value = PropertiesDAO::getProperty("DEFAULT_INSTRUTOR_ROLE");
        $role = null;
        if (isset($value)) {
            $role = self::getRoleById(strval($value));
        }
        if (!isset($role)) {
            $role = new Role(self::findUnallocatedID());
            $defaultRole = getInstructorRoleFull();
            $role->name = $defaultRole->name;
            $result = PermissionHolderKey::savePermissions($defaultRole);
            if ($result !== false) {
                $result = PermissionHolderKey::loadPermissions($role, $result);
            }
            PropertiesDAO::setProperty("DEFAULT_INSTRUTOR_ROLE", $role->getId());
            self::createRole($role);
        }
        return $role;
    }
    public static function getDefaultRoleForLearner()
    {
        $value = PropertiesDAO::getProperty("DEFAULT_LEARNER_ROLE");
        $role = null;
        if (isset($value)) {
            $role = self::getRoleById(strval($value));
        }
        if (!isset($role)) {
            $role = new Role(self::findUnallocatedID());
            $defaultRole = getLearnerRoleFull();
            $role->name = $defaultRole->name;
            $result = PermissionHolderKey::savePermissions($defaultRole);
            if ($result !== false) {
                $result = PermissionHolderKey::loadPermissions($role, $result);
            }
            PropertiesDAO::setProperty("DEFAULT_LEARNER_ROLE", $role->getId());
            self::createRole($role);
        }
        return $role;
    }
    public static function setDefaultRoleForInstructor(string $id)
    {
        $role = null;
        if (isset($id)) {
            $role = self::getRoleById($id);
        }
        if (isset($role)) {
            PropertiesDAO::setProperty("DEFAULT_INSTRUTOR_ROLE", $role->getId());
        }
        return $role;
    }
    public static function setDefaultRoleForLearner(string $id)
    {
        $role = null;
        if (isset($id)) {
            $role = self::getRoleById($id);
        }
        if (isset($role)) {
            PropertiesDAO::setProperty("DEFAULT_LEARNER_ROLE", $role->getId());
        }
        return $role;
    }

    public static function canDeleteRole(Role $role)
    {
        if (!isset($role))
            return false;

        $param = array($role->getId());
        $sql = "SELECT COUNT(*) AS `Count` FROM `profile` WHERE `profile`.`RoleID` = ?";
        $result = Database::executeQuery($sql, $param);
        if (isset($result) && count($result) !== 0 && floatval($result[0]["Count"]) !== floatval(0))
            return false;

        $sql = "SELECT COUNT(*) FROM `property` WHERE `property`.`Key` LIKE 'DEFAULT_%_ROLE' AND `property`.`Value` = ?";
        $result = Database::executeQuery($sql, $param);
        if (isset($result) && count($result) !== 0 && floatval($result[0]["Count"]) !== floatval(0))
            return false;
        return true;
    }

    public static function deleteRole(Role $role)
    {
        if (!self::canDeleteRole($role))
            return false;

        return Database::executeNonQuery("DELETE FROM `role` WHERE `role`.`ID` = ?", array($role->getId()));
    }
}
?>