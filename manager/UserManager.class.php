<?php
require_once 'class\User.php';

interface IUserManager {
    public static function authenticate($emailInput, $passwordInput);
}

class SimpleUserManager implements IUserManager {
    private static $email = 'test@test.com';
    private static $password = '1234';

    public static function authenticate($emailInput, $passwordInput) {
        try {
            if ($emailInput == self::$email && $passwordInput == self::$password) {
                return new User($emailInput, $passwordInput);
            }
            else {
                throw new Exception('Invalid email or password');
            }
        }
        catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}