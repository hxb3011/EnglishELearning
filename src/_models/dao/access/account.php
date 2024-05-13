<?
require_once "/var/www/html/_lib/utils/requir.php";
requirm('/dao/database.php');
requirm('/access/permission.php');

final class AccountDAO
{
    public static function getAllAccounts()
    {
        $sql = "SELECT * FROM `account`";
        $result = Database::executeQuery($sql);
        $accounts = array();
        if ($result === null)
            return $accounts;

        foreach ($result as $key => $value) {
            $account = new Account(
                $value["UID"],
                $value["UserName"],
                $value["Password"],
                $value["Status"]
            );
            PermissionHolderKey::loadPermissions($account, $value["Permissions"]);
            array_push($accounts, $account);
        }
        return $accounts;
    }
    public static function getAccountByUid(string $uid)
    {
        $sql = "SELECT * FROM `account` WHERE `uid` = ?";
        $result = Database::executeQuery($sql, array($uid));
        if ($result === null || count($result) !== 0)
            return null;

        $value = $result[0];
        $account = new Account(
            $value["UID"],
            $value["UserName"],
            $value["Password"],
            $value["Status"]
        );
        PermissionHolderKey::loadPermissions($account, $value["Permissions"]);
        return $account;
    }
    public static function lookupAccounts(string $keywords)
    {
        # code...
    }
    public static function createAccount()
    {
        # code...
    }
    public static function updateAccount(Account $account)
    {
        # code...
    }
    public static function deleteAccount(Account $keywords)
    {
        # code...
    }
}
?>