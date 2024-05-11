<?php
require_once '/var/www/html/_lib/utils/requir.php';
requirl("composer/vendor/autoload.php");

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$clientID = '703067388748-dohmftrk9jqmr2tr4uv9l7ilv075a9g8.apps.googleusercontent.com';
$clientSecret = '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';
$redirectUri = 'http://localhost:62280/authentication/authenticate.php';

// create Client Request to access Google API
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope("email");
$client->addScope("profile");

// authenticate code from Google OAuth Flow
try {
    if (isset($_GET['code'])) {
        $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
        if (isset($token['access_token'])) {
            $client->setAccessToken($token['access_token']);
            if ($client->isAccessTokenExpired()) {
                $client->revokeToken();
                unset($_SESSION['access_token']);
                unset($_SESSION['email']);
                unset($_SESSION['name']);
            }
            $google_oauth = new Google\Service\Oauth2($client);
            $google_account_info = $google_oauth->userinfo->get();
            $email =  $google_account_info->email;
            $name =  $google_account_info->name;
            if (!empty($email) && !empty($name)) {
                $_SESSION['email'] = $email;
                $_SESSION['name'] = $name;
                header("location: introduction/index.php");
            } else {
                throw new Exception("Error fetching user info");
            }
        } else {
            throw new Exception("Error fetching access token");
        }
    }
} catch (Exception $e) {
    error_log($e->getMessage());
    header("location: /error.php");
}

return $client;

