<?
require_once "/var/www/html/_lib/utils/requir.php";
class ForgetPassword {
    public function __construct() {
        
    }

    public function forgetpasswordView() {
        requirv("login/forgetpassword.php");
        global $page;
        $page = new ForgetPasswordPage();
        requira("_layout.php");
    }

    public function forgetpasswordService(){
        requirl("/oopControllers/ForgetPasswordService.php");
        $json = file_get_contents('php://input');
        // Converts it into a PHP array
        $data = json_decode($json, true);
        new ForgetPasswordService($data);
    }
}

$forgetpassword = new ForgetPassword();
if (!isset($_POST['email']))
    $forgetpassword->forgetpasswordView();
else
    $forgetpassword->forgetpasswordService();