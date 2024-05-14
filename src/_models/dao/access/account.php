<?
require_once "/var/www/html/_lib/utils/requir.php";
requirm('/dao/database.php');
requirm('/access/permission.php');

final class AccountDAO
{
    public static function getTotalAccounts(?string $name = null)
    {
        if (isset($name)) {
            $sqlQuery = "SELECT COUNT(*) AS total_accounts FROM `account` WHERE CONCAT(`LastName`, `FirstName`) LIKE CONCAT('%', ?, '%') OR CONCAT(`FirstName`, `LastName`) LIKE CONCAT('%', ?, '%')";
            $params = array($name, $name);
        } else {
            $sqlQuery = "SELECT COUNT(*) AS total_accounts FROM `account`";
            $params = null;
        }
        $result = Database::executeQuery($sqlQuery, $params);
        if (!isset($result) || count($result) === 0)
            return floatval(0);
        return floatval($result[0]['total_accounts']);
    }
    public static function getAccountFromPage(int $page = 1, int $perPage = 5, ?string $name = null)
    {
        $offSet = ($page - 1) * $perPage;
        if (isset($name)) {
            $sqlQuery = "SELECT * FROM `account` WHERE `UserName` LIKE CONCAT('%', ?, '%') LIMIT $offSet, $perPage";
            $params = array($name);
        } else {
            $sqlQuery = "SELECT * FROM `account` LIMIT $offSet, $perPage";
            $params = null;
        }
        $result = Database::executeQuery($sqlQuery, $params);

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
        $sql = "SELECT * FROM `account` WHERE `Status` < 4";
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
        // 000 001 010 011 100 101 110 111
        if (isset($currentAccount)) {
            $sql = "SELECT * FROM `account` WHERE (`UID` <> 0 AND MOD(`Status`, 2) = 0) OR `UID` = ?";
            $params = array($currentAccount);
        } else {
            $sql = "SELECT * FROM `account` WHERE MOD(`Status`, 2) = 0";
            $params = array();
        }
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
        $sql = "SELECT * FROM `account` WHERE `Status` < 4 AND `uid` = ?";
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
    public static function isUserNameExist(string $testUserName)
    {
        $sql = "SELECT COUNT(*) AS `AccountCount` FROM `account` WHERE `Status` < 4 AND `UserName` = ?";
        $result = Database::executeQuery($sql, array($testUserName));
        return $result !== null && count($result) !== 0 && intval($result[0]["AccountCount"]) !== 0;
    }
    public static function findUnallocatedUID()
    {
        $sql = "SELECT `UID`, `Status` FROM `account` WHERE `Status` > 3";
        $result = Database::executeQuery($sql);
        if (!isset($result) || count($result) === 0) {
            $sql = "SELECT COUNT(*) AS AccountCount FROM `account` WHERE `Status` < 4";
            $result = Database::executeQuery($sql);
            if (!isset($result) || count($result) === 0)
                return "0";
            else
                return strval($result[0]["AccountCount"]);
        }
        return strval(count($result));
    }
    public static function createAccount(Account $account)
    {
        if (!isset($account))
            return false;
        $sql = "SELECT `UID`, `Status` FROM `account` WHERE `Status` > 3 AND `UID` = ?";
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
        $sql = "UPDATE `account` SET `Status` = ? WHERE `UID` = ?";
        $uid = $account->getUid();
        $account->setDeleted(true);
        $state = $account->getState();
        return Database::executeNonQuery($sql, array($state, $uid));
    }
}
?>