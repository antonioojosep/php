<?php
class User
{

    private $username;
    private $type;

    public function __construct($username, $type)
    {
        $this->username = $username;
        $this->type = $type;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getType()
    {
        return $this->type;
    }
}
