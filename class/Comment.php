<?php
    class Post {
        private $commentId;
        private $commentBody;
        private $postId;
        private $email;
        private $publicationDate;

        public function __construct($commentId, $commentBody, $postId,$email,$publicationDate) {
            $this->commentId = $commentId;
            $this->commentBody = $commentBody;
            $this->postId = $postId;
            $this->email = $email;
            $this->publicaitonDate = $publicationDate;
        }

        public function getId() {
            return $this->commentId;
        }

        public function getBody() {
            return $this->commentBody;
        }

        public function getPost() {
            return $this->postId;
        }

        public function getEmail() {
            return $this->email;
        }
        public function getPublicationDate() {
            return $this->publicationDate;
        }
    }