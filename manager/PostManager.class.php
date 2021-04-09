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