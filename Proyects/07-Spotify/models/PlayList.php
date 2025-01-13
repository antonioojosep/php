<?php

class PlayList
{
    private $id;
    private $ownerId;
    private $name;
    private $songs = array();

    public function __construct($id, $ownerId, $name)
    {
        $this->id = $id;
        $this->ownerId = $ownerId;
        $this->name = $name;
        $this->songs = SongRepository::getSongsByPlayList($this->id);
    }

    public function getId()
    {
        return $this->id;
    }
    public function getOwner()
    {
        return UserRepository::getUserById($this->ownerId);
    }
    public function getName()
    {
        return $this->name;
    }
    public function getSongs()
    {
        return $this->songs;
    }
}
