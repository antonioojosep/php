<?php
class PlaylistRepository
{
    public static function getAllPlaylistByUser($user) : array
    {
        $db = Connection::connect();
        $q = "SELECT * FROM playlists WHERE user_id = '$user->id'";
        $result = $db->query($q);
        $Playlist = array();

        while ($row = $result->fetch_assoc()) {
            $Playlist[] = new Playlist($row['id'],$row['title'],$row['user_id']);
        }

        return $Playlist;
    }

    public static function getPlaylistById($id) : Playlist
    {
        $db = Connection::connect();
        $q = "SELECT * FROM playlists WHERE id='$id'";        
        $result = $db->query($q);
        $data = $result->fetch_assoc();

        return new Playlist($data['id'],$data['title'],$data['user_id']);
    }

    public static function addPlaylist($title,$user)
    {
        $db = Connection::connect();
        $q = "INSERT INTO playlists (`title`,`user_id`) VALUES ('$title','$user->id')";
        $db->query($q);
    }

    public static function searchPlaylist($title,$user)
    {
        $db = Connection::connect();
        $q = "SELECT * FROM playlists WHERE title LIKE '%$title%' AND user_id='$user->id'";
        $result = $db->query($q);
        $Playlists = array();
        while ($row = $result->fetch_assoc()) {
            $Playlists[] = new Playlist($row['id'], $row['title'],$row['user_id']);
        }

        return $Playlists;
    }
}