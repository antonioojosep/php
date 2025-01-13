<?php

class User{
    private $username;
    private $avatar;

    public function __construct($username)
    {
        $this->username = $username;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getAvatar() {
        return $this->avatar;
    }

    public function changeAvatar($avatar) {
        $this->avatar = $avatar;
    }
}