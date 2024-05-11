<?
require_once "/var/www/html/_lib/utils/requir.php";
requirm('/dao/database.php');
requirm('/profile/profile.php');
requirm('/dao/access/account.php');
requirm('/dao/access/role.php');

final class ProfileDAO
{
    public static function getAllProfiles()
    {
        $sql = "SELECT * FROM `profile`";
        $result = Database::executeQuery($sql);
        if ($result === null)
            return array();
        foreach ($result as $key => $value) {
            $prof = new Profile(
                $value["ID"],
                $value["FirstName"],
                $value["LastName"],
                $value["Gender"],
                $value["BirthDay"],
                $value["Type"],
                $value["Status"]
            );
            $key = $prof->getKey();
            if ($key instanceof PermissionHolderKey)
                $key->set(
                    AccountDAO::getAccountByUid($value["UID"]),
                    RoleDAO::getRoleById($value["RoleID"])
                );
        }
    }
    public static function getProfileByUid(string $uid)
    {
        $sql = "SELECT * FROM `profile` WHERE `uid` = ?";
        $result = Database::executeQuery($sql, array($uid));
        if ($result === null || count($result) === 0)
            return null;
        $value = $result[0];
        $prof = new Profile(
            $value["ID"],
            $value["FirstName"],
            $value["LastName"],
            $value["Gender"],
            $value["BirthDay"],
            $value["Type"],
            $value["Status"]
        );
        $key = $prof->getKey();
        if ($key instanceof PermissionHolderKey)
            $key->set(
                AccountDAO::getAccountByUid($value["UID"]),
                RoleDAO::getRoleById($value["RoleID"])
            );

        return $prof;
    }
    public static function lookupProfiles(string $keywords)
    {
        # code...
    }
    public static function createProfile()
    {
        # code...
    }
    public static function updateProfile(Profile $profile)
    {
        # code...
    }
    public static function deleteProfile(Profile $keywords)
    {
        # code...
    }
}
?>