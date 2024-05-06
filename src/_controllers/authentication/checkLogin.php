<?
require_once "/var/www/html/_lib/utils/requir.php";
class LoginController {
    public function __construct() {
        requirl("/oopControllers/authentication.php");
        $json = file_get_contents('php://input');
        // Converts it into a PHP array
        $data = json_decode($json, true);
        new Authentication($data);
    }
}

new LoginController();