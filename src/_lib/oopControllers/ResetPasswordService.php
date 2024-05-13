<?
require_once "/var/www/html/_lib/utils/requir.php";
requirm("/dao/accounts.php");

class ResetPasswordService {
    public function __construct($formdata) {
        $action = $formdata['action'];
        if ($action == 'resetPassword') {
            $token = $formdata['token'];
            $password = $formdata['password'];
            $this->resetpassword($token, $password);
        }
    }

    public function resetPassword($token, $password) {
        try {
            $userRepo = new UserRepo();
            $email = $userRepo->getEmailByToken($token);
            if ($email == null) {
                echo 'Token is invalid';
                return;
            }
            $username = $userRepo->findUserNameByEmail($email);
            if ($username == null) {
                echo 'Username is null';
                return;
            }
            if ($userRepo->resetPassword($password,$username)) {
                echo 'success';
            } else {
                echo 'failed';
            }
        } catch (Exception $e) {
            throw new ($e->getMessage());
        }
    }
}