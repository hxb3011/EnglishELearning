<?php
require_once "/var/www/html/_lib/utils/requir.php";
// requirm("userModel.php");

class Authentication
{

    public function __construct()
    {
    }

    public function auth()
    {
        requirv("login/authenticate.php");
        global $page;
        $page = new AuthenticatePage();
        requira("_layout.php");
    }

    public function forgetpassword()
    {
        requirv("login/forgetpassword.php");
        global $page;
        $page = new ForgetPasswordPage();
        requira("_layout.php");
    }

    public function logout()
    {
        session_start();
        session_destroy();
        header('Location: /');
    }

    public function checkLogin()
    {
        require_once "/var/www/html/_lib/Models/userModel.php";

        $user = new UserModel();
        $username = $_POST['username'];
        $password = $_POST['password'];
        $result = $user->checkLogin($username, $password);
        if ($result) {
            session_start();
            $_SESSION['username'] = $username;
            header('Location: /');
        } else {
            header('Location: /login');
        }
    }

    public function checkRegister()
    {
        $user = new UserModel();
        $username = $_POST['username'];
        $password = $_POST['password'];
        $result = $user->checkRegister($username, $password);
        if ($result) {
            session_start();
            $_SESSION['username'] = $username;
            header('Location: /');
        } else {
            header('Location: /register');
        }
    }
}