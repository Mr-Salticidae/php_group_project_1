<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post List</title>
</head>
<body>
    <h1>Post List</h1>
    <form method="post">
    <input type="number" name="id">
    <input type="submit" name="find" value="Find">
    <input type="submit" name="delete" value="Delete">
    <input type="submit" name="viewComment" value="View Comment">
    </form>
    <?php
        require_once 'manager\PostManager.class.php';
        // Session Part

        // $simplePostManager = new SimplePostManager();
        // session_start();
        // if (isset($_POST['find'])) {
        //     if (0 <= $_POST['id'] && $_POST['id'] < $_SESSION['counter']) {
        //         $post = $simplePostManager->findPostById($_POST['id']);
        //         echo $post->getUser() . ' ' . $post->getTitle() . ' ' . $post->getBody();
        //         echo '<br>';
        //     }
        //     else {
        //         echo 'Could not find a post with id: ' . $_POST['id'] . '<br>';
        //     }
        // }
        // if (isset($_POST['delete'])) {
        //     if (0 <= $_POST['id'] && $_POST['id'] < $_SESSION['counter']) {
        //         $simplePostManager->removePost($_POST['id']);
        //     }
        //     else {
        //         echo 'Could not find a post with id: ' . $_POST['id'] . '<br>';
        //     }
        // }
        // echo '<br>';
        // $posts = $simplePostManager->findAllPosts();
        // $i = 0;
        // foreach ($posts as $post) {
        //     echo $i . ' ' . $post->getUser() . ' ' . $post->getTitle() . ' ' . $post->getBody();
        //     $i += 1;
        //     echo '<br>';
        // }
        
        // Pdo Part

        $pdoPostManager = new PdoPostManager();
        if (isset($_POST['find'])) {
            $post = $pdoPostManager->findPostById($_POST['id']);
            if ($post) {
                echo $post['postId'] . ' ' . $post['title'] . ' ' . $post['body'] . ' ' . $post['email'];
            }
            else {
                echo 'Could not find a post with id: ' . $_POST['id'] . '<br>';
            }
            echo '<br>';
        }
        if (isset($_POST['delete'])) {
            $pdoPostManager->removePost($_POST['id']);
        }
        echo '<br>';
        $posts = $pdoPostManager->findAllPosts();
        foreach ($posts as $post) {
            echo $post['postId'] . ' ' . $post['title'] . ' ' . $post['body'] . ' ' . $post['email'];
            echo '<br>';
        }
        if (isset($_POST['viewComment'])) {
            $post = $pdoPostManager->findPostById($_POST['id']);
            if ($post) {
                session_start();
                $_SESSION['postId'] = $_POST['id'];
                header('Location: commentList.php');
            }
            else {
                echo 'Could not find a post with id: ' . $_POST['id'] . '<br>';
            }
            echo '<br>';
        }
    ?>
</body>
</html>