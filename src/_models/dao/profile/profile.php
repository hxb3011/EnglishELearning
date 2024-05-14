<?
require_once "/var/www/html/_lib/utils/requir.php";
requirm('/dao/database.php');
requirm('/profile/profile.php');
requirm('/dao/access/account.php');
requirm('/dao/access/role.php');

final class ProfileDAO
{
    public static function getTotalProfiles(?string $name = null)
    {
        if (isset($name)) {
            $sqlQuery = "SELECT COUNT(*) AS total_profiles FROM `profile` WHERE CONCAT(`LastName`, `FirstName`) LIKE CONCAT('%', ?, '%') OR CONCAT(`FirstName`, `LastName`) LIKE CONCAT('%', ?, '%')";
            $params = array($name, $name);
        } else {
            $sqlQuery = "SELECT COUNT(*) AS total_profiles FROM `profile`";
            $params = null;
        }
        $result = Database::executeQuery($sqlQuery, $params);
        if (!isset($result) || count($result) === 0)
            return floatval(0);
        return floatval($result[0]['total_profiles']);
    }
    public static function getProfileFromPage(int $page = 1, int $perPage = 5, ?string $name = null)
    {
        $offSet = ($page - 1) * $perPage;
        if (isset($name)) {
            $sqlQuery = "SELECT * FROM `profile` WHERE CONCAT(`LastName`, `FirstName`) LIKE CONCAT('%', ?, '%') OR CONCAT(`FirstName`, `LastName`) LIKE CONCAT('%', ?, '%') LIMIT $offSet, $perPage";
            $params = array($name, $name);
        } else {
            $sqlQuery = "SELECT * FROM `profile` LIMIT $offSet, $perPage";
            $params = null;
        }
        $result = Database::executeQuery($sqlQuery, $params);

        $profiles = array();
        if ($result === null || count($result) === 0)
            return $profiles;

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
            array_push($profiles, $prof);
        }
        return $profiles;
    }

    public static function getAllProfiles()
    {
        $sql = "SELECT * FROM `profile`";
        $result = Database::executeQuery($sql);
        $profiles = array();
        if ($result === null || count($result) === 0)
            return $profiles;

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
            array_push($profiles, $prof);
        }
        return $profiles;
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
    public static function getProfileById(string $id)
    {
        $sql = "SELECT * FROM `profile` WHERE `id` = ?";
        $result = Database::executeQuery($sql, array($id));
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
    public static function findUnallocatedID(): string
    {
        $sql = "SELECT COUNT(*) AS ProfileCount FROM `profile`";
        $result = Database::executeQuery($sql);
        if (!isset($result) || count($result) === 0)
            return "0";
        else
            return strval($result[0]["ProfileCount"]);
    }
    public static function createProfile(Profile $profile)
    {
        if (!isset($account))
            return false;
        $sql = "INSERT INTO `profile`(`ID`, `FirstName`, `LastName`, `Gender`, `BirthDay`, `Type`, `Status`, `UID`, `RoleID`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $profileId = $profile->getId();
        $firstName = $profile->firstName;
        $lastName = $profile->lastName;
        $gender = $profile->gender;
        $birthDay = $profile->birthday;
        $type = $profile->type;
        $status = $profile->status;
        $uid = "";
        $account = $profile->getAccount();
        if (isset($account))
            $uid = $account->getUid();
        $roleID = "";
        $role = $profile->getRole();
        if (isset($account))
            $roleID = $role->getId();
        return Database::executeNonQuery($sql, array($profileId, $firstName, $lastName, $gender, $birthDay, $type, $status, $uid, $roleID));
    }
    public static function updateProfile(Profile $profile)
    {
        if (!isset($account))
            return false;
        $sql = "UPDATE `profile` SET `FirstName` = ?, `LastName` = ?, `Gender` = ?, `BirthDay` = ?, `Type` = ?, `Status` = ?, `UID` = ?, `RoleID` = ? WHERE `ID` = ?";
        $profileId = $profile->getId();
        $firstName = $profile->firstName;
        $lastName = $profile->lastName;
        $gender = $profile->gender;
        $birthDay = $profile->birthday;
        $type = $profile->type;
        $status = $profile->status;
        $uid = "";
        $account = $profile->getAccount();
        if (isset($account))
            $uid = $account->getUid();
        $roleID = "";
        $role = $profile->getRole();
        if (isset($account))
            $roleID = $role->getId();
        return Database::executeNonQuery($sql, array($firstName, $lastName, $gender, $birthDay, $type, $status, $uid, $roleID, $profileId));
    }
    public static function deleteProfile(Profile $profile)
    {
        if (!isset($account))
            return false;
        $sql = "DELETE FROM `profile` WHERE `ID` = ?";
        $profileId = $profile->getId();
        return Database::executeNonQuery($sql, array($profileId));
    }
}
?>