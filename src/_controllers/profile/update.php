<?
require_once "/var/www/html/_lib/utils/requir.php";
requirl("profile/permissionChecker.php");

$holder = getPermissionHolder();
$_REQUEST["uri"] = $_SERVER['REQUEST_URI'];
$reqm = &$_SERVER['REQUEST_METHOD'];
if (!isset($reqm) || strtolower($reqm) !== "post") {
    http_response_code(404);
    $_REQUEST["ersp"] = "404";
    requira("_error.php");
} else {
    $profile = null;
    $account = null;
    if ($holder instanceof Profile) {
        $profile = $holder;
        $account = $profile->getAccount();
    } elseif ($holder instanceof Account) {
        $profile = null;
        $account = $holder;
    }
    $result = null;
    if (isset($account)) {
        $password = &$_REQUEST["uname"];
        if (isset($password)) {
            $length = strlen($password);
            if (
                $length >= 6 && $length <= 255 && preg_match("@^\s+$@", $password) !== 1
                && $password !== $account->userName && !AccountDAO::isUserNameExist($password)
            ) {
                $account->userName = $password;
                $result = AccountDAO::updateAccount($account);
            }
        }
    }
    if (isset($profile)) {
        $validLastName = false;
        $validFirstName = false;
        $validGender = false;
        $validBirthday = false;

        $lastName = &$_REQUEST["lname"];
        if (isset($lastName)) {
            $length = strlen($lastName);
            $validLastName = $length > 0 && $length <= 255 && preg_match("@^\s+$@", $lastName) !== 1;
            if ($validLastName) $profile->lastName = $lastName;
        }
        $firstName = &$_REQUEST["fname"];
        if (isset($firstName)) {
            $length = strlen($firstName);
            $validFirstName = $length > 0 && $length <= 255 && preg_match("@^\s+$@", $firstName) !== 1;
            if ($validFirstName) $profile->firstName = $firstName;
        }
        $gender = &$_REQUEST["gender"];
        if (isset($gender)) {
            $gender = intval($gender);
            $validGender = $gender === Gender_Male || $gender === Gender_Female;
            if ($validGender) $profile->gender = $gender;
        }
        $birthday = &$_REQUEST["birthday"];
        if (isset($birthday)) {
            $length = strlen($birthday);
            $validBirthday = $length > 0 && preg_match("@^\d{4}-\d{2}-\d{2}$@", $birthday) == 1;
            if ($validBirthday) $profile->birthday = $birthday;
        }
        if ($validLastName || $validFirstName || $validGender || $validBirthday) {
            $result = ProfileDAO::updateProfile($profile);
        }
    }
    if (!isset($result)) {
        http_response_code(403);
        $_REQUEST["ersp"] = "403";
        requira("_error.php");
    } else
        header("Location: /profile/index.php");
}
?>