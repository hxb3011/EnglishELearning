<?php
require_once "/var/www/html/_lib/utils/requir.php";
requirm("/dao/accounts.php");

class ForgetPasswordService {

    public function __construct($formdata) {
        $action = $formdata['action'];
        if ($action == 'forgetPassword') {
            $email = $formdata['email'];
            $this->forgetpassword($email);
        }
    }

    public function forgetpassword($email)
    {
        try {
            $userRepo = new UserRepo();
            $isEmailExist = $userRepo->checkEmail($email);
            if ($isEmailExist) {
                if ($userRepo->updateResetToken($email)) {
                    if ($userRepo->getResetToken($email) == null) {
                        echo 'Token is null';
                        return;
                    }
                    $token = $userRepo->getResetToken($email);
                    $mail = require "/var/www/html/_lib/configs/mailerConfig.php";
                    $mail->setFrom("noreply@example.com");
                    $mail->addAddress($email);
                    $mail->Subject = "Password Reset";
                    $mail->Body = <<<END
                    Click <a href="http://localhost:62280/authentication/resetpassword.php?token=$token">here</a> 
                    to reset your password.
                    END;
                    try {
                       $mail->send();
                    } catch (Exception $e) {
                        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
                    }
                    echo 'success';
                }
            } else {
                echo 'Email is not exist';
            }
        } catch (Exception $e) {
            throw new ($e->getMessage());
        }
    }

    public function logout()
    {
        session_start();
        session_destroy();
        header('Location: /authentication/authenticate.php');
    }
}