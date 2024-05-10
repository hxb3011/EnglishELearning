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
            $sqlQuery = "SELECT * FROM account ac 
                         join profile pf on ac.UID = pf.UID
                         join verification vr on pf.id = vr.ProfileID
                         WHERE username = ? OR email = ?";
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

    public function checkEmail($email)
    {
        try {
            $sqlQuery = "SELECT COUNT(*) FROM account ac
                     join profile pf on ac.UID = pf.UID
                     join verification vr on pf.id = vr.ProfileID
                     WHERE email = ?";
            $result = Database::executeQuery($sqlQuery, [$email]);
            if ($result !== null && $result[0]['COUNT(*)'] > 0){
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

    public function Register($username, $password, $email, $firstName, $lastName, $gender, $birthday)
    {
        try {
            $sqlCheckExistUserNameOrEmail = "select * from account ac 
                                             join profile pf on ac.UID = pf.UID
                                             join verification vr on pf.id = vr.ProfileID
                                             where UserName = ? or email = ?";
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
                $permissions = "user";
                $paramsAccount = array($uid, $username, $password, $status, $permissions);
                $resultAccount = $this->insertAccount($paramsAccount);
                if ($resultAccount) {
                    $idProfile = uniqid();
                    $type = "user";
                    $status = 1;
                    $roleID = "1";
                    $newGender = $gender == "male" ? 1 : 0;
                    $paramsProfile = array($idProfile, $lastName, $firstName, $newGender, $birthday, $type, $status, $uid, $roleID);
                    $resultProfile = $this->insertProfile($paramsProfile);
                    if ($resultProfile) {
                        $keyVerify = "z" . $email;
                        $paramsVerification = array($idProfile, $keyVerify, $email);
                        $resultVerification = $this->insertVerification($paramsVerification);
                        if ($resultVerification) {
                            return true;
                        }
                    }
                }
                return false;
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function insertAccount($params)
    {
        try {
            $sqlQuery = "INSERT INTO account (uid, username, password, status, permissions) VALUES (?, ?, ?, ?, ?)";
            $result = Database::executeNonQuery($sqlQuery, $params);
            return $result;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function insertProfile($params)
    {
        try {
            $sqlQuery = "INSERT INTO profile (id, lastname,firstname,  gender, birthday, type, status, uid, RoleID) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $result = Database::executeNonQuery($sqlQuery, $params);
            return $result;
        } catch (Exception $e) {

            throw new Exception($e->getMessage());
        }
    }

    public function insertVerification($params)
    {
        try {
            $sqlQuery = "INSERT INTO verification (profileID, keyVerify, email) VALUES (?, ?, ?)";
            $result = Database::executeNonQuery($sqlQuery, $params);
            return $result;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
