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

class PdoUserManager implements IUserManager {
    public static function authenticate($emailInput, $passwordInput) {
        try {
            $pdo = new PDO('mysql:host=localhost;port=3306;dbname=misc', 'root', 'root');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = 'SELECT * FROM users WHERE email = :em AND pass = :pa';
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
                ':em' => $emailInput,
                ':pa' => $passwordInput
            ));
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result) {
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