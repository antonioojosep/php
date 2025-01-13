<?php

class SongRepository
{

    public static function getSongs()
    {
        $connect = Connection::connect();
        $query = "SELECT * FROM songs";
        $result = $connect->query($query);
        $songs = [];
        while ($song = $result->fetch_assoc()) {
            $songs[] = new Song($song['id'], $song['title'], $song['author'], $song['duration'], $song['mp3'], $song['ownerId']);
        }
        return $songs;
    }

    public static function getSongById($id)
    {
        $connect = Connection::connect();
        $query = "SELECT * FROM songs WHERE id = $id";
        $result = $connect->query($query);
        if ($song = $result->fetch_assoc()) {
            return new Song($song['id'], $song['title'], $song['author'], $song['duration'], $song['mp3'], $song['ownerId']);
        }
        return false;
    }

    public static function addSong($title, $author, $duration, $mp3, $ownerId)
    {
        $connect = Connection::connect();
        $query = "INSERT INTO songs (title, author, duration, mp3, ownerId) VALUES ('$title', '$author', '$duration', '$mp3', $ownerId)";
        $connect->query($query);
        return $connect->insert_id;
    }

    public static function searchSongs($search)
    {
        $connect = Connection::connect();
        $query = "SELECT * FROM songs WHERE title LIKE '%$search%' OR author LIKE '%$search%'";
        $result = $connect->query($query);
        $songs = [];
        while ($song = $result->fetch_assoc()) {
            $songs[] = new Song($song['id'], $song['title'], $song['author'], $song['duration'], $song['mp3'], $song['ownerId']);
        }
        return $songs;
    }

    public static function getSongsByPlayList($playlistId)
    {
        $connect = Connection::connect();
        $query = "SELECT s.* FROM songs s, playlist_songs ps  WHERE ps.playlistId = $playlistId AND ps.songId = s.id";

        $result = $connect->query($query);
        $songs = [];
        while ($song = $result->fetch_assoc()) {
            $songs[] = new Song($song['id'], $song['title'], $song['author'], $song['duration'], $song['mp3'], $song['ownerId']);
        }
        return $songs;
    }
}
