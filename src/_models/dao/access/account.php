<?
require_once "/var/www/html/_lib/utils/requir.php";
requirm('/dao/database.php');
requirm('/access/permission.php');

final class AccountDAO
{
    public static function extractStateFlag(int $flag)
    {
        if ($flag > 0) {
            return "(MOD(`account`.`Status`, " . strval($flag << 1) . ") DIV " . strval($flag) . ")";
        }
        return "0";
    }
    public static function getStateHasFlagCondition(int $flag)
    {
        return "(" . self::extractStateFlag($flag) . " <> 0)";
    }
    public static function getStateHasNotFlagCondition(int $flag)
    {
        return "(" . self::extractStateFlag($flag) . " = 0)";
    }
    public static function encryptPassword(&$password)
    {
        if (isset($password) && is_string($password))
            return password_hash($password, PASSWORD_BCRYPT);
        else return password_hash("Hello|11", PASSWORD_BCRYPT);
    }

    public static function getTotalAccounts(?string $name = null)
    {
        if (isset($name)) {
            $likeNameCondition = " AND (`account`.`UserName` LIKE CONCAT('%', ?, '%'))";
            $params = array($name);
        } else {
            $likeNameCondition = "";
            $params = null;
        }
        $sql = "SELECT COUNT(*) AS total_accounts FROM `account` WHERE ";
        $sql = "`account`.`UID` <> '0' AND ";
        $sql .= self::getStateHasNotFlagCondition(AccountStates_Deleted);
        $sql .= $likeNameCondition;
        $result = Database::executeQuery($sql, $params);

        if (!isset($result) || count($result) === 0)
            return floatval(0);
        return floatval($result[0]['total_accounts']);
    }
    public static function getAccountFromPage(int $page = 1, int $perPage = 5, ?string $name = null)
    {
        $offSet = ($page - 1) * $perPage;
        if (isset($name)) {
            $likeNameCondition = " AND (`account`.`UserName` LIKE CONCAT('%', ?, '%'))";
            $params = array($name);
        } else {
            $likeNameCondition = "";
            $params = null;
        }
        $sql = "SELECT * FROM `account` WHERE ";
        $sql = "`account`.`UID` <> '0' AND ";
        $sql .= self::getStateHasNotFlagCondition(AccountStates_Deleted);
        $sql .= $likeNameCondition;
        $sql .= " LIMIT " . strval($offSet) . ", " . strval($perPage);
        $result = Database::executeQuery($sql, $params);

        $accounts = array();
        if ($result === null || count($result) === 0)
            return $accounts;

        foreach ($result as $key => $value) {
            $account = new Account(
                $value["UID"],
                $value["UserName"],
                $value["Password"],
                intval($value["Status"])
            );
            PermissionHolderKey::loadPermissions($account, $value["Permissions"]);
            array_push($accounts, $account);
        }
        return $accounts;
    }

    public static function getAllAccounts()
    {
        $sql = "SELECT * FROM `account` WHERE ";
        $sql = "`account`.`UID` <> '0' AND ";
        $sql .= self::getStateHasNotFlagCondition(AccountStates_Deleted);
        $result = Database::executeQuery($sql);
        $accounts = array();
        if ($result === null || count($result) === 0)
            return $accounts;

        foreach ($result as $key => $value) {
            $account = new Account(
                $value["UID"],
                $value["UserName"],
                $value["Password"],
                intval($value["Status"])
            );
            PermissionHolderKey::loadPermissions($account, $value["Permissions"]);
            array_push($accounts, $account);
        }
        return $accounts;
    }
    public static function getUnlinkedAccounts(?string $currentAccount)
    {
        if (isset($currentAccount)) {
            $includeCurrentCondition = "(`account`.`UID` <> '0' OR `account`.`UID` = ?) AND ";
            $params = array($currentAccount);
        } else {
            $includeCurrentCondition = "`account`.`UID` <> '0' AND ";
            $params = array();
        }

        $sql = "SELECT * FROM `account` WHERE ";
        $sql .= $includeCurrentCondition;
        $sql .= self::getStateHasNotFlagCondition(AccountStates_Deleted);
        $sql .= " AND ";
        $sql .= self::getStateHasNotFlagCondition(AccountStates_Linked);

        $result = Database::executeQuery($sql, $params);
        $accounts = array();
        if ($result === null || count($result) === 0)
            return $accounts;

        foreach ($result as $key => $value) {
            $account = new Account(
                $value["UID"],
                $value["UserName"],
                $value["Password"],
                intval($value["Status"])
            );
            PermissionHolderKey::loadPermissions($account, $value["Permissions"]);
            array_push($accounts, $account);
        }
        return $accounts;
    }
    public static function getAccountByUid(string $uid)
    {
        $sql = "SELECT * FROM `account` WHERE ";
        $sql .= self::getStateHasNotFlagCondition(AccountStates_Deleted);
        $sql .= " AND `account`.`UID` = ?";
        $result = Database::executeQuery($sql, array($uid));
        if ($result === null || count($result) === 0)
            return null;

        $value = $result[0];
        $account = new Account(
            $value["UID"],
            $value["UserName"],
            $value["Password"],
            intval($value["Status"])
        );
        PermissionHolderKey::loadPermissions($account, $value["Permissions"]);
        return $account;
    }
    public static function getAccountUidToLogin(string $subject, string $encryptedPassword)
    {
        $sql = "SELECT `account`.`UID` FROM `account` WHERE ";
        $sql .= self::getStateHasNotFlagCondition(AccountStates_Deleted);
        $sql .= " AND `account`.`UserName` = ? AND `account`.`Password` = ?";
        $result = Database::executeQuery($sql, array($subject, $encryptedPassword));
        if (isset($result) && count($result) !== 0) {
            echo $result[0]["UID"];
            return strval($result[0]["UID"]);
        }
        $sql = "SELECT `account`.`UID` FROM `account` JOIN `profile` ON `account`.`UID` = `profile`.`UID` JOIN `verification` ON `profile`.`ID` = `verification`.`ProfileID` WHERE ";
        $sql .= self::getStateHasNotFlagCondition(AccountStates_Deleted);
        $sql .= " AND `verification`.`email` = ? AND `account`.`Password` = ?";
        $result = Database::executeQuery($sql, array($subject, $encryptedPassword));
        if (isset($result) && count($result) !== 0) {
            return strval($result[0]["UID"]);
        }
        return null;
    }
    
    public static function isUserNameExist(string $testUserName)
    {
        $sql = "SELECT COUNT(*) AS `AccountCount` FROM `account` WHERE ";
        $sql .= self::getStateHasNotFlagCondition(AccountStates_Deleted);
        $sql .= " AND `account`.`UserName` = ?";
        $result = Database::executeQuery($sql, array($testUserName));
        return $result !== null && count($result) !== 0 && intval($result[0]["AccountCount"]) !== 0;
    }
    public static function findUnallocatedUID()
    {
        $sql = "SELECT `account`.`UID` FROM `account` WHERE ";
        $sql .= self::getStateHasFlagCondition(AccountStates_Deleted);
        $result = Database::executeQuery($sql);
        if (!isset($result) || count($result) === 0) {
            $sql = "SELECT COUNT(*) AS AccountCount FROM `account` WHERE ";
            $sql .= self::getStateHasNotFlagCondition(AccountStates_Deleted);
            $result = Database::executeQuery($sql);
            if (!isset($result) || count($result) === 0)
                return "0";
            else
                return strval($result[0]["AccountCount"]);
        }
        return strval($result[0][`UID`]);
    }
    public static function createAccount(Account $account)
    {
        if (!isset($account))
            return false;
        $sql = "SELECT `UID` FROM `account` WHERE ";
        $sql .= self::getStateHasFlagCondition(AccountStates_Deleted);
        $sql .= " AND `account`.`UID` = ?";
        $result = Database::executeQuery($sql, array($account->getUid()));
        if (isset($result) && count($result) !== 0)
            return self::updateAccount($account);

        $sql = "INSERT INTO `account`(`UID`, `UserName`, `Password`, `Status`, `Permissions`) VALUES (?, ?, ?, ?, ?)";
        $uid = $account->getUid();
        $userName = $account->userName;
        $password = $account->password;
        $status = $account->getState();
        $permissions = PermissionHolderKey::savePermissions($account);
        return Database::executeNonQuery($sql, array($uid, $userName, $password, $status, $permissions));
    }
    public static function updateAccount(Account $account)
    {
        if (!isset($account))
            return false;
        $sql = "UPDATE `account` SET `UserName` = ?, `Password` = ?, `Status` = ?, `Permissions` = ? WHERE `UID` = ?";
        $uid = $account->getUid();
        $userName = $account->userName;
        $password = $account->password;
        $status = $account->getState();
        $permissions = PermissionHolderKey::savePermissions($account);
        return Database::executeNonQuery($sql, array($userName, $password, $status, $permissions, $uid));
    }
    public static function deleteAccount(Account $account)
    {
        if (!isset($account) || ($account->isLinked() || $account->getUid() === "0"))
            return false;
        $account->setDeleted(true);
        $sql = "UPDATE `account` SET `Status` = ? WHERE `UID` = ?";
        return Database::executeNonQuery($sql, array($account->getState(), $account->getUid()));
    }
}
