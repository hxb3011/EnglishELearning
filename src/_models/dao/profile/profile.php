<?
require_once "/var/www/html/_lib/utils/requir.php";
requirm('/dao/database.php');
requirm('/profile/profile.php');
requirm('/profile/verification.php');
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
    public static function getProfileByType($type)
    {
        $sql = "SELECT * FROM `profile` WHERE Type = ? AND Status = 1";
        $param = array($type);
        $result = Database::executeQuery($sql, $param);
        if ($result === null || count($result) === 0)
            return array();
        $profiles = array();
        foreach ($result as $key => $profileRow) {
            $profile = new Profile(
                $profileRow["ID"],
                $profileRow["FirstName"],
                $profileRow["LastName"],
                $profileRow["Gender"],
                $profileRow["BirthDay"],
                $profileRow["Type"],
                $profileRow["Status"],
            );
            $profiles[] = $profile;
        }
        return $profiles;
    }
    public static function findUnallocatedID(): string
    {
        $sql = "SELECT COUNT(*) AS ProfileCount FROM `profile` WHERE `profile`.`ID` = ?";
        for ($i = 0; $i < 100; ++$i) {
            $id = uniqid(strval(0));
            $result = Database::executeQuery($sql, array($id));
            if (isset($result) && count($result) !== 0 && intval($result[0]["ProfileCount"]) === 0) {
                return $id;
            }
        }
        return uniqid();
    }
    public static function getAccountUidToLogin(string $subject, string $password)
    {
        $sql = "SELECT `account`.`UID`, `account`.`Password` FROM `account` WHERE ";
        $sql .= AccountDAO::getStateHasNotFlagCondition(AccountStates_Deleted);
        $sql .= " AND `account`.`UserName` = ?";
        $result = Database::executeQuery($sql, array($subject));
        if (isset($result) && count($result) !== 0 && password_verify($password, $result[0]["Password"])) {
            return strval($result[0]["UID"]);
        }
        $key = Verification::getKeyForOAuthEmail($subject);
        $sql = "SELECT `account`.`UID`, `account`.`Password` FROM `account` JOIN `profile` ON `account`.`UID` = `profile`.`UID` JOIN `verification` ON `profile`.`ID` = `verification`.`ProfileID` WHERE ";
        $sql .= AccountDAO::getStateHasNotFlagCondition(AccountStates_Deleted);
        $sql .= " AND `verification`.`KeyVerify` = ?";
        $result = Database::executeQuery($sql, array($key));
        if (isset($result) && count($result) !== 0 && password_verify($password, $result[0]["Password"])) {
            return strval($result[0]["UID"]);
        }
        return null;
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
        if (isset($account)) {
            $uid = $account->getUid();
            AccountDAO::updateAccount($account);
        }
        $roleID = "";
        $role = $profile->getRole();
        if (isset($account))
            $roleID = $role->getId();
        return Database::executeNonQuery($sql, array($profileId, $firstName, $lastName, $gender, $birthDay, $type, $status, $uid, $roleID));
    }
    public static function updateProfile(Profile $profile)
    {
        if (!isset($profile))
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
        if (isset($role))
            $roleID = $role->getId();
        return Database::executeNonQuery($sql, array($firstName, $lastName, $gender, $birthDay, $type, $status, $uid, $roleID, $profileId));
    }

    public static function canDeleteProfile(Profile $profile)
    {
        if (!isset($account))
            return false;

        $param = array($profile->getId());
        $sql = "SELECT COUNT(*) FROM `comment` WHERE `comment`.`AuthID` = ?";
        $result = Database::executeQuery($sql, $param);
        if (isset($result) && count($result) !== 0 && floatval($result[0]["Count"]) !== floatval(0))
            return false;

        $sql = "SELECT COUNT(*) FROM `contribution` WHERE `contribution`.`ProfileID` = ?";
        $result = Database::executeQuery($sql, $param);
        if (isset($result) && count($result) !== 0 && floatval($result[0]["Count"]) !== floatval(0))
            return false;

        $sql = "SELECT COUNT(*) FROM `course` WHERE `course`.`ProfileID` = ?";
        $result = Database::executeQuery($sql, $param);
        if (isset($result) && count($result) !== 0 && floatval($result[0]["Count"]) !== floatval(0))
            return false;

        $sql = "SELECT COUNT(*) FROM `execsresponse` WHERE `execsresponse`.`ProfileID` = ?";
        $result = Database::executeQuery($sql, $param);
        if (isset($result) && count($result) !== 0 && floatval($result[0]["Count"]) !== floatval(0))
            return false;

        $sql = "SELECT COUNT(*) FROM `learntrecord` WHERE `learntrecord`.`ProfileID` = ?";
        $result = Database::executeQuery($sql, $param);
        if (isset($result) && count($result) !== 0 && floatval($result[0]["Count"]) !== floatval(0))
            return false;

        $sql = "SELECT COUNT(*) FROM `payment` WHERE `payment`.`ProfileID` = ?";
        $result = Database::executeQuery($sql, $param);
        if (isset($result) && count($result) !== 0 && floatval($result[0]["Count"]) !== floatval(0))
            return false;

        $sql = "SELECT COUNT(*) FROM `post` WHERE `post`.`ProfileID` = ?";
        $result = Database::executeQuery($sql, $param);
        if (isset($result) && count($result) !== 0 && floatval($result[0]["Count"]) !== floatval(0))
            return false;

        $sql = "SELECT COUNT(*) FROM `tracking` WHERE `tracking`.`ProfileID` = ?";
        $result = Database::executeQuery($sql, $param);
        if (isset($result) && count($result) !== 0 && floatval($result[0]["Count"]) !== floatval(0))
            return false;

        $sql = "SELECT COUNT(*) FROM `verification` WHERE `verification`.`ProfileID` = ?";
        $result = Database::executeQuery($sql, $param);
        if (isset($result) && count($result) !== 0 && floatval($result[0]["Count"]) !== floatval(0))
            return false;
        return true;
    }

    public static function deleteProfile(Profile $profile)
    {
        if (!self::canDeleteProfile($profile))
            return false;
        $sql = "DELETE FROM `profile` WHERE `ID` = ?";
        $profileId = $profile->getId();
        return Database::executeNonQuery($sql, array($profileId));
    }
}
?>