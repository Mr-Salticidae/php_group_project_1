<?php
require_once 'class\Post.php';
require_once 'class\User.php';
interface IPostManager {
    function addPost($title, $body, $user);
    function findAllPosts();
    function findPostById($id);
    function removePost($id);
}

class SimplePostManager implements IPostManager {
    public function __construct() {
        if (!isset($_SESSION['posts'])) {
            $_SESSION['posts'] = [];
        }
        if (!isset($_SESSION['counter'])) {
            $_SESSION['counter'] = 0;
        }
    }

    public function addPost($title, $body, $user) {
        $post = new Post($title, $body, $user);
        $id = $_SESSION['counter'];
        $_SESSION['counter'] += 1;
        $_SESSION['posts'][$user][] = $post;
        echo 'Add Post Successfully';
    }

    function findAllPosts() {
        return $_SESSION['posts'][$_SESSION['user']];
    }

    function findPostById($id) {
        return $_SESSION['posts'][$_SESSION['user']][$id];
    }

    function removePost($id) {
        array_splice($_SESSION['posts'][$_SESSION['user']], $id);
        $_SESSION['counter'] -= 1;
        echo 'Remove Post Successfully';
    }
}

class PdoPostManager implements IPostManager {
    function addPost($title, $body, $user) {
        try {
            $pdo = new PDO('mysql:host=localhost;port=3306;dbname=misc', 'root', 'root');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = 'INSERT INTO posts (title, body, email) VALUES (:ti, :bo, :em)';
            $stmt = $pdo->prepare($sql);
            $result = $stmt->execute(array(
                ':ti' => $title,
                ':bo' => $body,
                ':em' => $user
            ));
            if ($result) {
                echo 'Add Post Successfully';
            }
            else {
                echo 'Failed to add post';
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    function findAllPosts() {
        try {
            $pdo = new PDO('mysql:host=localhost;port=3306;dbname=misc', 'root', 'root');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = 'SELECT * FROM posts';
            $stmt = $pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    function findPostById($id) {
        try {
            $pdo = new PDO('mysql:host=localhost;port=3306;dbname=misc', 'root', 'root');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = 'SELECT * FROM posts WHERE postId = :id';
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
                ':id' => (int)$id
            ));
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    function removePost($id) {
        try {
            $pdo = new PDO('mysql:host=localhost;port=3306;dbname=misc', 'root', 'root');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = 'DELETE FROM posts WHERE postId = :id';
            $stmt = $pdo->prepare($sql);
            $result = $stmt->execute(array(
                ':id' => (int)$id
            ));
            if ($result) {
                echo 'Delete Post Successfully';
            }
            else {
                echo 'Failed to delete post';
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}