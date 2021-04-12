<?php
require_once 'class\Post.php';
require_once 'manager\AbstractPdoManager.class.php';

interface CommentManager {
    public function addComment($commentBody, $postId, $user);
    public function getAllComments($postId);
}

class PdoCommentManager extends AbstractPdoManager implements CommentManager {
    function addComment($commentBody, $postId, $user) {
        try {
            $publicationDate = date('Y-m-d');
            $sql = 'INSERT INTO comments (comment_body, post_id, email, publicationDate) VALUES (:bo, :po, :em, :pu)';
            $stmt = $this->pdo->prepare($sql);
            $result = $stmt->execute(array(
                ':bo' => $commentBody,
                ':po' => $postId,
                ':em' => $user,
                ':pu' => $publicationDate
            ));
            if ($result) {
                echo 'Add comment Successfully';
            }
            else {
                echo 'Failed to add comment';
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    function getAllComments($postId) {
        try {
            $sql = 'SELECT * FROM comments WHERE post_id = :po';
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(array(
                ':po' => $postId
            ));
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}