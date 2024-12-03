<?php
class MatterRepository {
    public static function getAllResponseByMatter($id) {
        $db = Connection::connect();
        $q = "SELECT * FROM response where matter='$id'";
        $result = $db->query($q);
        $Responses = array();

        while ($row = $result->fetch_assoc()) {
            $Responses[] = new Response($row['id'],$row['text'],$row['status'], $row['matter'],$row['user']);
        }

        return $Responses;
    }

    public static function getMatterById($id)
     {
        $db = Connection::connect();
        $q = "SELECT * FROM matter WHERE id='$id'";
        $result = $db->query($q);
        $data = $result->fetch_assoc();

        return new Matter($data['id'],$data['name'],$data['status'],$data['forum']);
     }

     public static function addMatter($name,$forum)
     {
        $db = Connection::connect();
        $q = "INSERT INTO Matter (`name`,`forum`) values ('$name','$forum')";
        $db->query($q);
     }

     public static function deleteMatter($id)
     {
        $db = Connection::connect();
        $q = "DELETE FROM matter WHERE `matter`.`id` = $id";
        var_dump($q);
        $db->query($q);
     }

     public static function statusHandler($id)
     {
        $matter = MatterRepository::getMatterById($id);
        $db = Connection::connect();
        if ($matter->status == 'inactive') {
            $q = "UPDATE matter set status='active' WHERE id='$id'";
        }else {
            $q = "UPDATE matter set status='inactive' WHERE id='$id'";
        }
        $db->query($q);
     }
}