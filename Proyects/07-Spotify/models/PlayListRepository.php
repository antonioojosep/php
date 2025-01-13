<?php

class PlayListRepository
{
    public static function getPlayListById($id)
    {
        $connect = Connection::connect();
        $query = "SELECT * FROM playlist WHERE id = $id";
        $result = $connect->query($query);
        if ($playlist = $result->fetch_assoc()) {
            return new PlayList($playlist['id'], $playlist['user_id'], $playlist['name']);
        }
    }

    public static function getPlaylistsByUserId($userId)
    {
        $connect = Connection::connect();
        $query = "SELECT * FROM playlist WHERE user_id = $userId";
        $result = $connect->query($query);
        $playlists = [];
        while ($playlist = $result->fetch_assoc()) {
            $playlists[] = new PlayList($playlist['id'], $playlist['user_id'], $playlist['name']);
        }
        return $playlists;
    }

    public static function createPlaylist($name, $userId)
    {
        $connect = Connection::connect();
        $query = "INSERT INTO playlist (name, user_id) VALUES ('$name', $userId)";
        $connect->query($query);
        return $connect->insert_id;
    }

    public static function addSongToPlaylist($playlistId, $songId)
    {
        $connect = Connection::connect();
        $query = "INSERT INTO playlist_songs (playlistId, songId) VALUES ($playlistId, $songId)";
        $connect->query($query);
        return $connect->affected_rows;
    }

    public static function getPlaylistByName($name)
    {
        $connect = Connection::connect();
        $query = "SELECT * FROM playlist WHERE name = '$name'";
        $result = $connect->query($query);
        if ($playlist = $result->fetch_assoc()) {
            return new PlayList($playlist['id'], $playlist['user_id'], $playlist['name']);
        }
        return null;
    }
}
