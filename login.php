<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
</head>
<body>
    <h1>Welcome</h1>
    <form method="post">
    <label>Email:</label>
    <input type="text" name="email">
    <br>
    <label>Password:</label>
    <input type="password" name="password">
    <br>
    <input type="submit" name="login" value="Login">
    </form>
    <?php
    require_once './manager/UserManager.class.php';
    // Session part

    // if (isset($_POST['email']) && isset($_POST['password'])) {
    //     $simpleUserManager = new SimpleUserManager();
    //     $user = $simpleUserManager->authenticate($_POST['email'], $_POST['password']);
    //     if ($user != null) {
    //         header('Location: addPost.php?email=' . $user->getEmail());
    //         return;
    //     }
    // }
    
    // Pdo part

    if (isset($_POST['email']) && isset($_POST['password'])) {
        $pdoUserManager = new PdoUserManager();
        $user = $pdoUserManager->authenticate($_POST['email'], $_POST['password']);
        if ($user != null) {
            session_start();
            $_SESSION['user'] = $user;
            header('Location: addPost.php');
            return;
        }
    }
    ?>
</body>
</html>