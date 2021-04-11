<?php
require_once 'class\User.php';
require_once 'manager\AbstractPdoManager.class.php';

interface IUserManager {
    public function authenticate($emailInput, $passwordInput);
}

class SimpleUserManager implements IUserManager {
    private $email = 'test@test.com';
    private $password = '1234';

    public function authenticate($emailInput, $passwordInput) {
        try {
            if ($emailInput == $this->email && $passwordInput == $this->password) {
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

class PdoUserManager extends AbstractPdoManager implements IUserManager {
    public function authenticate($emailInput, $passwordInput) {
        try {
            $sql = 'SELECT * FROM users WHERE email = :em AND pass = :pa';
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(array(
                ':em' => $emailInput,
                ':pa' => $passwordInput
            ));
            $result = $stmt->fetch();
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