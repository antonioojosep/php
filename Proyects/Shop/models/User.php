<?php
class User{

    private $username;

    public function __construct($username)
    {
        $this->username = $username;
    }

    public function __getUsername()
    {
        return $this->username;
    }
}