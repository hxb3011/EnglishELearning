<?
session_start();
require_once "/var/www/html/_lib/utils/requir.php";
class ForgetPassword {
    public function __construct() {
        $this->forgetpasswordView();
    }

    public function forgetpasswordView() {
        requirv("login/forgetpassword.php");
        global $page;
        $page = new ForgetPasswordPage();
        requira("_layout.php");
    }
}

new ForgetPassword();
