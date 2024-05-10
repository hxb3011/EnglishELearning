<?
require_once "/var/www/html/_lib/utils/requir.php";
requirm('/dao/database.php');
requirm('/access/Account.php');

class ResetPasswordController {
    public function __construct() {
        $token = $_GET['token'];
        $token_hash = hash('sha256', $token);
        $sqlQuery = "SELECT * FROM account ac
                     join profile pf on ac.UID = pf.UID
                     join verification vr on pf.id = vr.ProfileID
                     WHERE reset_token_hash = ?";
        $result = Database::executeQuery($sqlQuery, [$token_hash]);
        if ($result === null){
            echo "Invalid token";
        }
        if (strtotime($result["reset_token_expires_at"]) <= time()){
            echo "Token expired";
        }
        $this->resetpasswordView();
    }

    public function resetpasswordView() {
        requirv("login/resetpassword.php");
        global $page;
        $page = new ResetPasswordPage();
        requira("_layout.php");
    }

}

new ResetPasswordController();