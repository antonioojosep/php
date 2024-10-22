<?php

class Comment {

    private $id;
    private $user;
    private $movieId;
    private $text;
    private $date;

    public function __construct($user, $movieId, $text) {

        $this->user = $user;
        $this->movieId = $movieId;
        $this->text = $text;
        $this->date = date('Y-m-d H:i:s');
    }

    public function getId() {
        return $this->id;
    }

    public function getUser() {
        return $this->user;
    }
    
    public function getMovieId() {
        return $this->movieId;
    }

    public function getComment() {
        return $this->text;
    }
    
    public function getDate() {
        return $this->date;
    }
}