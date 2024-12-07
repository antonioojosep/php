<?php
class SongRepository
{
    public static function getSongById($id) : Song
    {
        $db = Connection::connect();
        $q = "SELECT * FROM songs where id = '$id'";
        $result = $db->query($q);
        $data = $result->fetch_assoc();

        return new Song($data['id'],$data['title'],$data['author'], $data['length'],$data['fyle']);;
    }

    public static function addSong($title,$author,$length,$fyle)
    {
        $db = Connection::connect();
        $q = "INSERT INTO songs(`title`,`author`,`length`,`fyle`) VALUES ('$title','$author','$length','$fyle')";
        $db->query($q);
    }

    public static function searchSong($title,$author)
    {
        $db = Connection::connect();
        $q = "SELECT * FROM songs WHERE title LIKE '%$title%' AND author LIKE '%$author%'";
        $result = $db->query($q);
        $Songs = array();
        while ($row = $result->fetch_assoc()) {
            $Songs[] = new Song($row['id'], $row['title'],$row['author'],$row['length'],$row['fyle']);
        }

        return $Songs;
    }
}