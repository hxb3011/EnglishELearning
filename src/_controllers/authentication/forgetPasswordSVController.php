<?
require_once "/var/www/html/_lib/utils/requir.php";
class ForgetPasswordServiceController {

    public function __construct(){
        $this->forgetpasswordServiceController();
    }

    public function forgetpasswordServiceController(){
        requirl("/oopControllers/ForgetPasswordService.php");
        $json = file_get_contents('php://input');
        // Converts it into a PHP array
        $data = json_decode($json, true);
        new ForgetPasswordService($data);
    }
}
new ForgetPasswordServiceController();
