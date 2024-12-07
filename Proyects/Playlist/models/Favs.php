<?php
class Favs
{
    private int $id;
    private Playlist $playlist;
    private User $user;

    public function __construct($id,$playlistId,$userId)
    {
        $this->id = $id;
        $this->playlist = PlaylistRepository::getPlaylistById($playlistId);
        $this->user = UserRepository::getUserByUserId($userId);
    }

    public function __get($name)
    {
        if (property_exists($this,$name)) {
            return $this->$name;
        }
    }
}