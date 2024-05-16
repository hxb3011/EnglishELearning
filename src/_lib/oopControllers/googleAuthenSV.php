<?php
require_once "/var/www/html/_lib/utils/requir.php";
requirm('dao/profile/profile.php');
requirm('dao/profile/verification.php');
requirl("composer/vendor/autoload.php");

if (!session_id())
    session_start();

class GoogleLoginController
{
    private UserRepo $AccountCtl;
    private $client;

    public function __construct($formdata)
    {
        $this->client = $this->clientGoogle();
        // $this->AccountCtl = new UserRepo();
        $this->loginGoogle($this->client, $formdata);
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

    public function loginGoogle($client, $formdata)
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

                $firstName = $google_account_info->getGivenName();
                $lastName = $google_account_info->getFamilyName();
                $gender = $google_account_info->getGender();
                if ($gender === "male")
                    $gender = Gender_Male;
                elseif ($gender === "female")
                    $gender = Gender_Female;
                else
                    $gender = Gender_Unspecified;
                $email = $google_account_info->getEmail();

                $auth_uid = null;
                $verification = VerificationDAO::getProfileIdByOAuthEmail($email);
                if (!isset($verification)) {
                    $auth_uid = AccountDAO::findUnallocatedUID();
                    $username = "user" . $auth_uid;
                    $password = $email;
                    $password = AccountDAO::encryptPassword($password);
                    $account = new Account($auth_uid, $username, $password);
                    if (!AccountDAO::createAccount($account))
                        $auth_uid = null;

                    if (isset($auth_uid)) {
                        $role = RoleDAO::getDefaultRoleForLearner();
                        $pid = ProfileDAO::findUnallocatedID();
                        $birthday = "2000-01-01";
                        $profile = new Profile($pid, $firstName, $lastName, $gender, $birthday, ProfileType_Learner, 0);
                        $pkey = $profile->getKey();
                        if ($pkey instanceof PermissionHolderKey)
                            $pkey->set($account, $role);

                        if (!ProfileDAO::createProfile($profile)) {
                            if ($pkey instanceof PermissionHolderKey)
                                $pkey->set(null, null);
                            AccountDAO::deleteAccount($account);
                            $auth_uid = null;
                            return;
                        }
                        if (isset($auth_uid)) {
                            $verification = Verification::createWithOAuthEmail($pid, $email);
                            VerificationDAO::createVerification($verification);
                        }
                    }
                } else {
                    $profile = ProfileDAO::getProfileById($verification->getProfileId());
                    if (isset($profile)) {
                        $account = $profile->getAccount();
                        if (isset($account))
                            $auth_uid = $account->getUid();
                    }
                }
                if (isset($auth_uid)) {
                    $_SESSION['AUTH_UID'] = $auth_uid;
                    header("Location: /authentication/authenticate.php");
                } else {
                    http_response_code(500);
                    $_REQUEST["ersp"] = "500";
                    requira("_error.php");
                }
                exit;
            }
        } catch (Exception $e) {
            throw new ($e->getMessage());
        }
    }
}
