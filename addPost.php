<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Post</title>
</head>
<body>
    <?php
    require_once 'manager\PostManager.class.php';
    $pdoPostManager = new PdoPostManager();
    session_start();
    echo '<h1>Welcome ' . $_SESSION['user']->getEmail() . '</h1>';
    ?>
    <form method="post">
    <label>Title:</label>
    <input type="text" name="title">
    <br>
    <label>Body:</label>
    <input type="text" name="body">
    <br>
    <input type="submit" name="addPost" value="Add Post">
    <input type="submit" name="viewPosts" value="View Posts">
    </form>
    <?php
        // Session part

        // $simplePostManager = new SimplePostManager();
        // session_start();
        // if (isset($_POST['viewPosts'])) {
        //     header('Location: postList.php');
        //     return;        
        // }
        // if (isset($_POST['title']) && isset($_POST['body'])) {
        //     $_SESSION['user'] = $_GET['email'];  
        //     $simplePostManager->addPost($_POST['title'], $_POST['body'], $_SESSION['user']);          
        // }

        // Pdo part
        if (isset($_POST['viewPosts'])) {
            header('Location: postList.php');
            return;        
        }
        if (isset($_POST['title']) && isset($_POST['body'])) {
            $pdoPostManager->addPost($_POST['title'], $_POST['body'], $_SESSION['user']->getEmail());          
        }
    ?>
</body>
</html>