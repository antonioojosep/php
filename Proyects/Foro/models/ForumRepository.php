<?php

class ForumRepository {

    public static function getAllForums()
    {
        $db = Connection::connect();
        $q = 'SELECT * FROM forum';
        try {
            $result = $db->query($q);
            $Forums = array();

            while ($row = $result->fetch_assoc()) {
                $Forums[] = new Forum($row['id'], $row['name'], $row['public']); 
            }

            return $Forums;
        } catch (Exception $e) {
            echo "Error getAllForums " . $e;
        }
    }

    public static function getForumById($id)
    {
        $db = Connection::connect();
        $q = "SELECT * FROM forum where id='$id'";
        $result = $db->query($q);
        $data = $result->fetch_assoc();

        return new Forum($data['id'],$data['name'],$data['public']);
    }

    public static function createForum() {
        
    }

    public static function getMatterByForum($id) {
        $db = Connection::connect();
        $q = "SELECT * FROM matter where forum='$id'";
        $result = $db->query($q);
        $Matters = array();

        while ($row = $result->fetch_assoc()) {
            $Matters[] = new Matter($row['id'], $row['name'],$row['public'],$row['forum']);
        }

        return $Matters;
    }
}