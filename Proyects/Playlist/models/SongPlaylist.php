<?php
class SongPlaylist
{
    private int $id;
    private Playlist $playlistId;
    private Song $songId;

    public function __construct(int $id, int $playlistId, int $songId)
    {
        $this->id = $id;
        $this->playlistId = PlaylistRepository::getPlaylistById($playlistId);
        $this->songId = SongRepository::getSongById($songId);
    }

    public function __get($name)
    {
        if (property_exists($this,$name)) {
            return $this->$name;
        }
    }
}