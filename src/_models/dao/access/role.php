<?
require_once "/var/www/html/_lib/utils/requir.php";
requirm('/dao/database.php');
requirm('/access/permission.php');

final class RoleDAO
{
    public static function getAllRoles()
    {
        $sql = "SELECT * FROM `role`";
        $result = Database::executeQuery($sql);
        $roles = array();
        if ($result === null)
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
        if ($result === null || count($result) !== 0)
            return null;

        $value = $result[0];
        $role = new Role($value["ID"], $value["Name"]);
        PermissionHolderKey::loadPermissions($role, $value["Permissions"]);
        return $role;
    }
    public static function lookupRoles(string $keywords)
    {
        # code...
    }
    public static function createRole()
    {
        # code...
    }
    public static function updateRole(Role $role)
    {
        # code...
    }
    public static function deleteRole(Role $keywords)
    {
        # code...
    }
}
?>