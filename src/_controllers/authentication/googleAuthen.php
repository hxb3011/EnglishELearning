<?
require_once "/var/www/html/_lib/utils/requir.php";
class googleAuthenSVController {
    public function __construct() {
        $this->googleAuthenService();
    }

    public function googleAuthenService(){
        requirl("/oopControllers/googleAuthenSV.php");
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        new GoogleLoginController($data);
    }
}

new googleAuthenSVController();

