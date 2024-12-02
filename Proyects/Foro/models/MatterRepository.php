<?php
class MatterRepository {
    public static function getAllResponseByMatter($id) {
        $db = Connection::connect();
        $q = "SELECT * FROM response where matter='$id'";
        $result = $db->query($q);
        $Responses = array();

        while ($row = $result->fetch_assoc()) {
            $Responses[] = new Response($row['id'],$row['text'],$row['public'], $row['matter'],$row['user']);
        }

        return $Responses;
    }

    public static function getMatterById($id)
     {
        $db = Connection::connect();
        $q = "SELECT * FROM matter WHERE id='$id'";
        $result = $db->query($q);
        $data = $result->fetch_assoc();

        return new Matter($data['id'],$data['name'],$data['public'],$data['forum']);
     }
}