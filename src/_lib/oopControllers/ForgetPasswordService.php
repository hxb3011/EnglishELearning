<?php
require_once "/var/www/html/_lib/utils/requir.php";
requirm("/dao/accounts.php");

class ForgetPasswordService {

    public function __construct($formdata) {
        $action = $formdata['action'];
        if ($action == 'forgetpassword') {
            $email = $formdata['email'];
            $this->forgetpassword($email);
        }else {
            $this->logout();
        }
    }

    public function forgetpassword($email)
    {
        try {
            $userRepo = new UserRepo();
            $isEmailExist = $userRepo->checkEmail($email);
            if ($isEmailExist) {
                echo json_encode(array('status' => 'success', 'message' => 'Email is exist'));
            } else {
                echo json_encode(array('status' => 'error', 'message' => 'Email is not exist'));
            }
            
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function logout()
    {
        session_start();
        session_destroy();
        header('Location: /');
    }
}