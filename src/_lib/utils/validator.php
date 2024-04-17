<?php

final class Validator {
    public static function isValidEmail($input) {
        if (!is_string($input)) return false;
        $email_length = strlen($input);
        if ($email_length < 6 || $email_length >= 128) return false;
        return preg_match("@^[a-zA-Z0-9.! #$%&'*+/=?^_`{|}~-]{6,}\@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$@", $input) === 1;
    }

    public static function isValidUsername($input) {
        if (!is_string($input)) return false;
        $email_length = strlen($input);
        if ($email_length < 6 || $email_length >= 128) return false;
        return preg_match("@^[a-zA-Z0-9.! #$%&'*+/=?^_`{|}~-]{6,}$@", $input) === 1;
    }

    public static function isValidEmailOrUsername($input) {
        if (!is_string($input)) return false;
        $email_length = strlen($input);
        if ($email_length < 6 || $email_length >= 128) return false;
        if (preg_match("@^[a-zA-Z0-9.! #$%&'*+/=?^_`{|}~-]{6,}(\@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*)?$@", $input, $groups) !== 1) return false;
        $c = count($groups);
        if ($c === 3) return 1;
        if ($c === 2) return 2;
        return false;
    }

    public static function isValidPassword($input) {
        if (!is_string($input)) return false;
        return (preg_match("@^(?:([[:lower:]])|([[:upper:]])|([[:digit:]])|([[:punct:]])){8,127}$@", $input, $groups) === 1 && count($groups) === 5);
    }
}