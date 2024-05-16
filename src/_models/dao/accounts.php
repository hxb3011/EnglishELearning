<?php
requirm('/dao/database.php');
requirm('/access/Account.php');
requirm('dao/access/account.php');
class UserRepo
{
    public function checkEmail($email)
    {
        try {
            $sqlQuery = "SELECT COUNT(*) FROM account ac
                     join profile pf on ac.UID = pf.UID
                     join verification vr on pf.id = vr.ProfileID
                     WHERE email = ?";
            $result = Database::executeQuery($sqlQuery, [$email]);
            if ($result !== null && $result[0]['COUNT(*)'] > 0) {
                return true;
            }
            return false;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function updateResetToken($email)
    {
        try {
            $token = bin2hex(random_bytes(16));
            $token_hash = hash('sha256', $token);
            $expiry = date("Y-m-d H:i:s", time() + 60 * 30);
            $sqlQuery = "UPDATE verification SET reset_token_hash = ? ,
                        reset_token_expires_at = ? WHERE email = ?";
            $result = Database::executeNonQuery($sqlQuery, [$token_hash, $expiry, $email]);
            if ($result) {
                return true;
            }
            return false;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getResetToken($email)
    {
        $sqlQuery = "SELECT reset_token_hash FROM verification WHERE email = ?";
        $result = Database::executeQuery($sqlQuery, [$email]);
        if ($result !== null) {
            return $result[0]['reset_token_hash'];
        }
        return null;
    }

    public function getEmailByToken($token)
    {
        $sqlQuery = "SELECT email FROM verification WHERE reset_token_hash = ?";
        $result = Database::executeQuery($sqlQuery, [$token]);
        if ($result !== null) {
            return $result[0]['email'];
        }
        return null;
    }

    public function resetPassword($password, $username)
    {
        $password = password_hash($password, PASSWORD_BCRYPT);
        $sqlQuery = "UPDATE account SET password = ? WHERE username = ?";
        $result = Database::executeNonQuery($sqlQuery, [$password, $username]);
        if ($result) {
            return true;
        }
        return false;
    }

    public function findUserNameByEmail($email)
    {
        $sqlQuery = "SELECT username FROM account ac
                     join profile pf on ac.UID = pf.UID
                     join verification vr on pf.id = vr.ProfileID
                     WHERE email = ?";
        $result = Database::executeQuery($sqlQuery, [$email]);
        if ($result !== null) {
            return $result[0]['username'];
        }
        return null;
    }
}
