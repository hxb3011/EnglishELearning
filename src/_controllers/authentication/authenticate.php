<?
require_once("/var/www/html/_lib/utils/requir.php");
class AuthenticateRegisterController{

    public function __construct() {
        requirv("login/authenticateRegister.php");
        global $page;
        $page = new AuthenticateRegisterPage();
        requira("_layout.php");
    }
    
}

new AuthenticateRegisterController();


