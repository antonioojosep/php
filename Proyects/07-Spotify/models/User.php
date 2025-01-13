<?php

class User
{
    private $id;
    private $username;
    private $avatar;
    private $rol;

    public function __construct($id, $username, $rol)
    {
        $this->id = $id;
        $this->username = $username;
        $this->rol = $rol;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getAvatar()
    {
        return $this->avatar;
    }

    public function setAvatar($avatar)
    {
        $this->$avatar = $avatar;
    }

    public function getRol()
    {
        return $this->rol;
    }

    public function setRol($rol)
    {
        $this->rol = $rol;
    }


    public function getPlayLists()
    {
        return PlayListRepository::getPlayListsByUserId($this->id);
    }
}
