<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comment List</title>
</head>
<body>
    <h1>Comment List</h1>
    <form method="post">
    <input type="text" name="commentBody">
    <input type="submit" name="addComment" value="Add Comment">
    </form>

    <?php
    require_once 'manager\CommentManager.class.php';
    require_once 'class\User.php';
    $pdoCommentManager = new PdoCommentManager();
    session_start();
    if (isset($_POST['commentBody']) && isset($_POST['addComment'])) {
        $pdoCommentManager->addComment($_POST['commentBody'], $_SESSION['postId'], $_SESSION['user']->getEmail());
    }
    
    echo '<br>';
        $comments = $pdoCommentManager->getAllComments($_SESSION['postId']);
        foreach ($comments as $comment) {
            echo $comment['comment_id'] . ' ' . $comment['comment_body'] . ' ' . $comment['email'] . ' ' . $comment['publicationDate'];
            echo '<br>';
        }
    ?>
</body>
</html>