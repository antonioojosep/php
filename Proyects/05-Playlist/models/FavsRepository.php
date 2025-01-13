<?php
class FavsRepository
{
    public static function getFavsByUser($user)
    {
        $db = Connection::connect();
        $q = "SELECT * FROM favs WHERE user_id = '$user->id'";
        $result = $db->query($q);
        $Favs = array();

        while ($row = $result->fetch_assoc()) {
            $Favs[] = PlaylistRepository::getPlaylistById($row['playlist_id']);
        }

        return $Favs;
    }

    public static function addFav($playlistId,$user)
    {
        $db = Connection::connect();
        $q = "INSERT INTO favs(`playlist_id`,`user_id`) VALUES ('$playlistId','$user->id')";
        $db->query($q);
    }
}