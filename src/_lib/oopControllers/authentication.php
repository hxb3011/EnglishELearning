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
        $data = $obj;
        $username = $data['username'];
        $password = $data['password'];
        $action = $data['action'];
        if ($action == "login") {
            $subject = $username;
            $this->login($subject, $password);
        } else if ($action == "register") {
            $email = $data['email'];
            $this->register($username, $password, $email);
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
            if (!$user->checkPassword($password)) {
                echo "Password is incorrect";
                return;
            }
            $auth = $user->Login($subject, $password);
            if ($auth != null) {
                if (!isset($_SESSION)) {
                    session_start();
                }
                $_SESSION["username"] = $auth['UserName'];
                $_SESSION["Permissions"] = $auth['Permissions'];
                echo "success";
            } else {
                echo "Account was not exists";
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function register($username, $password, $email)
    {
        try {
            $user = new UserRepo();
            echo $user->Register($username, $password, $email) ? "success" : "";
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
