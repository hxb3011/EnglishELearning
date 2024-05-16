<?php
require_once "/var/www/html/_lib/utils/requir.php";
requirm("dao/profile/profile.php");
requirm("dao/profile/verification.php");
class Authentication
{
    public function __construct($formdata)
    {
        $this->auth($formdata);
    }

    public function auth($obj)
    {
        $action = $obj['action'];
        if ($action == "login") {
            $this->login($obj['username'], $obj['password']);
        } else if ($action == "register") {
            $this->register($obj);
        }
    }

    public function isEmailOrUsername($subject)
    {
        if (filter_var($subject, FILTER_VALIDATE_EMAIL)) {
            return "email";
        } else {
            if (preg_match('/^[a-zA-Z0-9]*$/', $subject)) {
                return "username";
            }
            return "invalid";
        }
    }

    public function login(&$subject, &$password)
    {
        try {
            if (!isset($subject) || strlen($subject) == 0 || !isset($password) || strlen($password) == 0) {
                echo "Username hoặc mật khẩu bỏ trống";
                return;
            }
            $auth_uid = ProfileDAO::getAccountUidToLogin($subject, $password);
            if (isset($auth_uid)) {
                if (!session_id())
                    session_start();

                $sauth_uid = &$_SESSION['AUTH_UID'];
                if (!isset($sauth_uid) || empty($sauth_uid)) {
                    $sauth_uid = $auth_uid;
                    echo "success";
                } else {
                    echo "Đã có tài khoản đăng nhập.";
                }
            } else {
                echo "Username hoặc mật khẩu không đúng";
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function register($obj)
    {
        try {
            $uid = AccountDAO::findUnallocatedUID();
            $username = &$obj['username'];
            if (!empty($username)) {
                $username = strval($username);
                if (AccountDAO::isUserNameExist($username)) {
                    echo "Tên người dùng đã tồn tại";
                    return;
                }
            } else
                $username = "user" . $uid;

            $password = &$obj['password'];
            $password = AccountDAO::encryptPassword($password);

            $account = new Account($uid, $username, $password);
            if (!AccountDAO::createAccount($account)) {
                echo "Tạo tài khoản thất bại";
                return;
            }

            $role = RoleDAO::getDefaultRoleForLearner();
            $pid = ProfileDAO::findUnallocatedID();

            $firstName = &$obj['firstname'];
            if (empty($firstName))
                $firstName = "First Name";
            else
                $firstName = strval($firstName);

            $lastName = &$obj['lastname'];
            if (empty($lastName))
                $lastName = "Last Name";
            else
                $lastName = strval($lastName);

            $gender = &$obj['gender'];
            $gender = isset($gender) && $gender !== "male" ? Gender_Female : Gender_Male;

            $birthday = &$obj['birthday'];
            if (empty($birthday))
                $birthday = "2000-01-01";
            else
                $birthday = strval($birthday);

            $profile = new Profile($pid, $firstName, $lastName, $gender, $birthday, ProfileType_Learner, 0);
            $pkey = $profile->getKey();
            if ($pkey instanceof PermissionHolderKey)
                $pkey->set($account, $role);

            if (!ProfileDAO::createProfile($profile)) {
                echo "Tạo hồ sơ thất bại";
                if ($pkey instanceof PermissionHolderKey)
                    $pkey->set(null, null);
                AccountDAO::deleteAccount($account);
                return;
            }

            $email = &$obj['email'];
            if (!empty($email)) {
                $v = new Verification($pid, "");
                $v->setEmail(strval($email));
                if (!VerificationDAO::createVerification($v)) {
                    echo "success"; // Lưu email thất bại
                    return;
                }
            }
            echo "success";
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
