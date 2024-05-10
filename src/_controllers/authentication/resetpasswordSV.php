<?
require_once "/var/www/html/_lib/utils/requir.php";
class resetPasswordSVController {
    public function __construct() {
        $this->ResetServiceController();
    }

    public function ResetServiceController(){
        requirl("/oopControllers/ResetPasswordService.php");
        $json = file_get_contents('php://input');
        // Converts it into a PHP array
        $data = json_decode($json, true);
        new ResetPasswordService($data);
    }
}

new resetPasswordSVController();