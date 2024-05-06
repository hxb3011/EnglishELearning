<?php
requirm('/dao/database.php');
requirm('/access/Account.php');
class UserRepo
{

    public function getNumberOfTotalAccount()
    {
        $sqlQuery = "SELECT COUNT(*) AS total_account FROM account";
        try {
            $result = Database::executeQuery($sqlQuery);
            return $result;
        } catch (Exception $e) {
            return null;
        }
    }

    public function generateValidAccountID()
    {
        $total_string = $this->getNumberOfTotalAccount();
        // echo "<script>console.log('total_string: $total_string')</script>";
        $total = intval($total_string) + 1;
        // echo "<script>console.log('total: $total')</script>";
        return 'UID' . $total;
    }

    public function Login($subject, $password)
    {
        try {
            $sqlQuery = "SELECT * FROM account WHERE username = ? OR email = ?";
            $result = Database::executeQuery($sqlQuery, [$subject, $subject]);
            if ($result !== null && count($result) > 0) {
                $user = $result[0];
                if (isset($user['Password']) && password_verify($password, $user['Password'])) {
                    return $user;
                }
            }
            return null;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function checkPassword($password)
    {
        $sqlQuery = "SELECT password FROM account WHERE password = ?";
        $result = Database::executeQuery($sqlQuery, [$password]);
        if ($result !== null && count($result) > 0) {
            return true;
        }
        return false;
    }

    public function checkEmail($email)
    {
        $sqlQuery = "SELECT email FROM account WHERE email = ?";
        $result = Database::executeQuery($sqlQuery, [$email]);
        if ($result !== null && count($result) > 0) {
            return true;
        }
        return false;
    }

    public function updateResetToken($email)
    {
        try {
            $token = bin2hex(random_bytes(16));
            $token_hash = hash('sha256', $token);
            $expiry = date("Y-m-d H:i:s", time() + 60 * 30);
            $sqlQuery = "UPDATE account SET reset_token_hash = ? ,
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


    public function Register($username, $password, $email)
    {
        try {
            $sqlCheckExistUserNameOrEmail = "SELECT * FROM account WHERE username = ? OR email = ?";
            $paramsCheck = array(
                "username" => $username,
                "email" => $email
            );
            $result = Database::executeQuery($sqlCheckExistUserNameOrEmail, $paramsCheck);
            if ($result != null) {
                echo ("User email or username already registered");
                return false;
            } else {
                $uid = uniqid();
                $password = password_hash($password, PASSWORD_BCRYPT);
                $status = 1;
                $sqlQuery = 'INSERT INTO account (uid, username, password, status,permissions, email) VALUES (?, ?, ?, ?, ?, ?)';
                $params = array(
                    "uid" => $uid,
                    "username" => $username,
                    "password" => $password,
                    "status" => $status,
                    "permissions" => "user",
                    "email" => $email
                );
                $result = Database::executeNonQuery($sqlQuery, $params);
                return $result;
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
