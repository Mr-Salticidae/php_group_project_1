<?php
    class Post {
        private $title;
        private $body;
        private $user;

        public function __construct($title, $body, $user) {
            $this->title = $title;
            $this->body = $body;
            $this->user = $user;
        }

        public function getTitle() {
            return $this->title;
        }

        public function getBody() {
            return $this->body;
        }

        public function getUser() {
            return $this->user;
        }
    }