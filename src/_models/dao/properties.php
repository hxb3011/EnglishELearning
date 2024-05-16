<?
require_once "/var/www/html/_lib/utils/requir.php";
requirm('/dao/database.php');

final class PropertiesDAO
{
    public static function ensurePropertiesCreated() {
        $sql = "CREATE TABLE IF NOT EXISTS `property` ( `Key` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL, `Value` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL, PRIMARY KEY (`Key`) ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";
        $result = Database::executeNonQuery($sql);
        return !$result;
    }
    public static function getProperty(string $key) {
        self::ensurePropertiesCreated();
        $sql = "SELECT `Value` FROM `property` WHERE `Key` = ?";
        $result = Database::executeQuery($sql, array($key));
        if (isset($result) && count($result) !== 0) return strval($result[0]["Value"]);
        else null;
    }
    public static function setProperty(string $key, string $value) {
        self::ensurePropertiesCreated();
        $sql = "INSERT INTO `property` (`Value`, `Key`) VALUES (?, ?)";
        $params = array($value, $key);
        $result = Database::executeNonQuery($sql, $params);
        if (!$result) {
            $sql = "UPDATE `property` SET `Value` = ? WHERE `Key` = ?";
            $result = Database::executeNonQuery($sql, $params);
        }
        return $result;
    }
}
?>