<?php
class authenController {

    public function __construct() {
        
    }
    
    public function auth() {
        require_once(APP_ROOT . '/content/views/login/authenticate.php');
    }

    public function forgetpassword() {
        require_once(APP_ROOT . '/content/views/login/forgetpassword.php');
    }

    public function logout() {
        session_start();
        session_destroy();
        header('Location: /');
    }
    
    public function checkLogin() {
        require_once '/content/models/userModel.php';
        // $user = new UserModel();
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
    public function checkRegister() {
        require_once '/content/models/userModel.php';
        // $user = new UserModel();
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