<?php
class Favorites {
    private $id;
    private $user;
    private $movieId;

    public function __construct($user, $movieId) {
        $this->user = $user;
        $this->movieId = $movieId;
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

}
?>