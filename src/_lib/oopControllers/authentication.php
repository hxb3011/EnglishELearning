<?php
require_once "/var/www/html/_lib/utils/requir.php";
requirm("/dao/accounts.php");
class Authentication
{
    public function __construct($formdata)
    {
        $this->auth($formdata);
    }

    public function auth($obj)
    {
        $username = $obj['username'];
        $password = $obj['password'];
        $action = $obj['action'];
        if ($action == "login") {
            $subject = $username;
            $this->login($subject, $password);
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

    public function login($subject, $password)
    {
        try {
            if (strlen($subject) == 0 || strlen($password) == 0) {
                echo "Username or password is empty";
                return;
            }
            $user = new UserRepo();
            $auth = $user->Login($subject, $password);
            if ($auth != null) {
                if (!isset($_SESSION)) {
                    session_start();
                }
                $_SESSION["username"] = $auth['UserName'];
                $_SESSION["Permissions"] = $auth['Permissions'];
                echo "success";
            } else {
                echo "Account was not exists or password was incorrect";
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function register($obj)
    {
        try {
            $username = $obj['username'];
            $password = $obj['password'];
            $email = $obj['email'];
            $firstName = $obj['firstname'];
            $lastName = $obj['lastname'];
            $gender = $obj['gender'];
            $birthday = $obj['birthday'];
            $user = new UserRepo();
            echo $user->Register($username,$password,$email,$firstName,$lastName,$gender,$birthday) ? "success" : "";
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
