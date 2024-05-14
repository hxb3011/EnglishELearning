<?
require_once "/var/www/html/_lib/utils/requir.php";
requirm('/dao/database.php');
requirm('/access/permission.php');

final class RoleDAO
{
    public static function getTotalRoles(?string $name = null)
    {
        if (isset($name)) {
            $sqlQuery = "SELECT COUNT(*) AS total_roles FROM `role` WHERE `Name` LIKE CONCAT('%', ?, '%')";
            $params = array($name, $name);
        } else {
            $sqlQuery = "SELECT COUNT(*) AS total_roles FROM `role`";
            $params = null;
        }
        $result = Database::executeQuery($sqlQuery, $params);
        if (!isset($result) || count($result) === 0)
            return 0;
        return intval($result[0]['total_roles']);
    }
    public static function getRoleFromPage(int $page = 1, int $perPage = 5, ?string $name = null)
    {
        $offSet = ($page - 1) * $perPage;
        if (isset($name)) {
            $sqlQuery = "SELECT * FROM `role` WHERE `Name` LIKE CONCAT('%', ?, '%') LIMIT $offSet, $perPage";
            $params = array($name, $name);
        } else {
            $sqlQuery = "SELECT * FROM `role` LIMIT $offSet, $perPage";
            $params = null;
        }
        $result = Database::executeQuery($sqlQuery, $params);

        $roles = array();
        if ($result === null || count($result) === 0)
            return $roles;

        foreach ($result as $key => $value) {
            $role = new Role($value["ID"], $value["Name"]);
            PermissionHolderKey::loadPermissions($role, $value["Permissions"]);
            array_push($profiles, $role);
        }
        return $roles;
    }

    public static function getAllRoles()
    {
        $sql = "SELECT * FROM `role`";
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
        $sql = "SELECT COUNT(*) AS RoleCount FROM `role`";
        $result = Database::executeQuery($sql);
        if (!isset($result) || count($result) === 0)
            return "0";
        else
            return strval($result[0]["RoleCount"]);
    }
    public static function lookupRoles(string $keywords)
    {
        # code...
    }
    public static function createRole(Role $role)
    {
        if (!isset($role))
            return false;
        $sql = "INSERT INTO `role`(`ID`, `Name`) VALUES (?, ?)";
        $uid = $role->getId();
        $userName = $role->name;
        return Database::executeNonQuery($sql, array($uid, $userName));
    }
    public static function updateRole(Role $role)
    {
        if (!isset($role))
            return false;
        $sql = "UPDATE `role` SET `Name` = ? WHERE `ID` = ?";
        $id = $role->getId();
        $name = $role->name;
        return Database::executeNonQuery($sql, array($name, $id));
    }
    // public static function deleteRole(Role $role)
    // {
    //     if (!isset($role))
    //         return false;
    //     $sql = "DELETE FROM `role` WHERE `ID` = ?";
    //     $roleId = $role->getId();
    //     return Database::executeNonQuery($sql, array($roleId));
    // }
}
?>