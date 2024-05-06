<?
require_once("/var/www/html/_lib/utils/requir.php");
class AuthenticateController{

    public function __construct() {
        requirv("login/authenticate.php");
        global $page;
        $page = new AuthenticatePage();
        requira("_layout.php");
    }
    
}

new AuthenticateController();


