<?
require_once "/var/www/html/_lib/utils/requir.php";

const VerificationType_Phone = 1;
const VerificationType_Email = 2;
const VerificationType_OAuthEmail = 3;

final class Verification
{
    public string $profileId;
    private string $_key;
    public function __construct(string $profileId, string $key)
    {
        $this->profileId = $profileId;
        $this->_key = $key;
    }

    function getProfileId()
    {
        return $this->profileId;
    }

    function getType()
    {
        if (str_starts_with($this->_key, "x")) {
            return VerificationType_Phone;
        } elseif (str_starts_with($this->_key, "z")) {
            return VerificationType_Email;
        } elseif (str_starts_with($this->_key, "y")) {
            return VerificationType_OAuthEmail;
        } else
            return 0;
    }

    function getPhone()
    {
        $key = $this->_key;
        if (str_starts_with($key, "x")) {
            return substr($key, 1);
        }
        return null;
    }

    function setPhone(string $phone)
    {
        $this->_key = "x" . $phone;
    }

    function getEmail()
    {
        $key = $this->_key;
        if (str_starts_with($key, "z") || str_starts_with($key, "y")) {
            return substr($key, 1);
        }
        return null;
    }

    function setEmail(string $email)
    {
        $this->_key = "z" . $email;
    }

    function getKey()
    {
        return $this->_key;
    }

    public static function getKeyForOAuthEmail(string $email)
    {
        return "y" . $email;
    }

    public static function createWithOAuthEmail(string $profileId, string $email)
    {
        return new Verification($profileId, self::getKeyForOAuthEmail($email));
    }
}
?>