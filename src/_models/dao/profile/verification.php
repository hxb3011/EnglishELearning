<?
require_once "/var/www/html/_lib/utils/requir.php";
requirm('/dao/database.php');
requirm('/profile/verification.php');

final class VerificationDAO
{
    public static function getProfileIdByOAuthEmail(string $email)
    {
        $sql = "SELECT * FROM `verification` WHERE `KeyVerify` = ?";
        $result = Database::executeQuery($sql, array($email));
        if ($result === null || count($result) === 0)
            return null;
        $value = $result[0];
        return new Verification($value["ProfileID"], $value["KeyVerify"]);
    }
    public static function getAllVerificationsByProfileID(string $profileID)
    {
        $sql = "SELECT * FROM `verification` WHERE `ProfileID` = ?";
        $result = Database::executeQuery($sql, array($profileID));
        $vs = array();
        if ($result === null || count($result) === 0)
            return $vs;

        foreach ($result as $key => $value) {
            array_push(
                $vs,
                new Verification(
                    $value["ProfileID"],
                    $value["KeyVerify"]
                )
            );
        }
        return $vs;
    }
    public static function createVerification(Verification $verification)
    {
        if (!isset($verification))
            return false;
        $sql = "INSERT INTO `verification`(`ProfileID`, `KeyVerify`) VALUES (?, ?)";
        $id = $verification->getProfileId();
        $key = $verification->getKey();
        return Database::executeNonQuery($sql, array($id, $key));
    }
    public static function deleteVerification(Verification $verification)
    {
        if (!isset($verification))
            return false;
        $sql = "DELETE FROM `verification` WHERE `ProfileID` = ? AND `KeyVerify` = ?";
        $id = $verification->getProfileId();
        $key = $verification->getKey();
        return Database::executeNonQuery($sql, array($id, $key));
    }
}
?>