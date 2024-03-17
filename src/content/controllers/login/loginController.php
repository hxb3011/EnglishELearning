<?php
class loginController {
    public function index() {
        echo 'Login Page';
    }
    public function register() {
        require_once './src/content/views/register.php';
    }
    public function logout() {
        session_start();
        session_destroy();
        header('Location: /');
    }
    public function checkLogin() {
        require_once './src/content/models/userModel.php';
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
        require_once './src/content/models/userModel.php';
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