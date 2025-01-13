<?php
class SongPlaylistRepository
{
    public static function getAllSongPlaylist()
    {
        $db = Connection::connect();
        $q = "SELECT * FROM playlist_songs";
        $result = $db->query($q);
        $Alls = array();
        while ($row = $result->fetch_assoc()) {
            $Alls[] = new SongPlaylist($row['id'],$row['playlist_id'],$row['song_id']);
        }
        return $Alls;
    }

    public static function getAllSongByPlaylist(int $playlistId)
    {
        $db = Connection::connect();
        $q = "SELECT * FROM playlist_songs WHERE playlist_id = '$playlistId'";
        $result = $db->query($q);
        $Songs = array();

        while ($row = $result->fetch_assoc()) {
            $Songs[] = SongRepository::getSongById($row['song_id']);
        }

        return $Songs;
    }

    public static function getAllPlaylistBySong(int $songId)
    {
        $db = Connection::connect();
        $q = "SELECT * FROM playlist_songs WHERE song_id = '$songId'";
        $result = $db->query($q);
        $Playlist = array();

        while ($row = $result->fetch_assoc()) {
            $Playlist[] = PlaylistRepository::getPlaylistById($row['playlist_id']);
        }

        return $Playlist;
    }

    public static function addSongTo($playlistId,$songId)
    {
        $db = Connection::connect();
        $q = "INSERT INTO playlist_songs(`playlist_id`,`song_id`) VALUES ('$playlistId','$songId')";
        $db->query($q);
    }
}