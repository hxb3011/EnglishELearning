<!-- <?
namespace utils;

use Respect\Validation\Validator as v;

class Validation {
    public static function validateEmail($email) {
        return v::email()->validate($email);
    }

    public static function validatePassword($password) {
        return v::stringType()->length(6, 20)->validate($password);
    }
}
?> -->