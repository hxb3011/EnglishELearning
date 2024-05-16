<?php
require_once "/var/www/html/_lib/utils/requir.php";
requirm("/dao/accounts.php"); // ?converting
requirm('dao/access/account.php');
requirl("composer/vendor/autoload.php");

if (!session_id())
    session_start();

class GoogleLoginController
{
    private $AccountCtl;
    private $client;

    public function __construct($formdata)
    {
        $this->client = $this->clientGoogle();
        $this->AccountCtl = new UserRepo();
        $this->loginGoogle($this->client,$formdata);
    }

    public function getProfileLength()
    {
        return AccountDAO::getTotalAccounts();
    }

    public function getProfile($email)
    {
        return $this->AccountCtl->checkEmail($email);
    }

    public function addProfile($email,$firstName, $lastName, $gender, $birthday)
    {
        try {
            $length = $this->getProfileLength();
            if ($length >= 0) {
                $length += 1;
                $id = 'KH_' . "_" . sprintf("%04d", $length);
                if ($firstName === '') $firstName = 'Unknown';
                if ($lastName === '') $lastName = 'Unknown';
                if ($gender === '') $gender = 'Unknown';
                if ($birthday === '') {
                    $newbirthday = new DateTime();
                    $birthday = $newbirthday->format('Y-m-d');
                }
                $username = $id;
                $password = 'google';
                $this->AccountCtl->Register($username, $password, $email, $firstName, $lastName, $gender, $birthday);
            }
            return false;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getLoginInfo($username)
    {
        return $this->AccountCtl->getLoginInfo($username);
    }

    public function clientGoogle()
    {
        $client_id = '703067388748-c8jh0o37b3t5eoi8d83chmmb2ig6qvqt.apps.googleusercontent.com';
        $client_secret = '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';
        $redirect_uri = 'http://localhost:62280/authentication/authenticate.php';
        $client = new Google\Client();
        $client->setClientId($client_id);
        $client->setClientSecret($client_secret);
        $client->setRedirectUri($redirect_uri);
        $client->addScope(Google\Service\Oauth2::USERINFO_EMAIL);
        // $client->addScope(Google\Service\Oauth2::USERINFO_PROFILE);
        return $client;
    }

    public function getGoogleUrl()
    {
        $client = $this->clientGoogle();
        $url = $client->createAuthUrl();
        return $url;
    }

    public function loginGoogle($client,$formdata)
    {
        $action = isset($formdata['action']) ? $formdata['action'] : '';
        switch ($action) {
            case 'get-google-url':
                echo $this->getGoogleUrl();
                break;
            default:
                break;
        }

        try {
            if (!empty($_GET['code'])) {
                $client = $this->client;
                $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
                $client->setAccessToken($token['access_token']);
                $google_oauth = new Google\Service\Oauth2($client);
                $google_account_info = $google_oauth->userinfo->get();
                $email =  $google_account_info->email;
                // $name =  $google_account_info->name;
                if (!$this->getProfile($email)) {
                    $this->addProfile($email,  '', '', '', '');
                }
                $info = $this->getLoginInfo($email);
                session_regenerate_id();
                $_SESSION['AUTH_UID'] = $info['uid'];
                header("Location: /authentication/authenticate.php");
                exit;
            }
        } catch (Exception $e) {    
            throw new ($e->getMessage());
        }
    }
}
