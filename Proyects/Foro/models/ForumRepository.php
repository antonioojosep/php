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
                $Forums[] = new Forum($row['id'], $row['name'], $row['type']); 
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

        return new Forum($data['id'],$data['name'],$data['type']);
    }

    public static function createForum($name) {
        $db = Connection::connect();
        $q = "INSERT INTO forum (`name`) values ('$name')";
        $db->query($q);
    }

    public static function deleteForum($id) {
        $db = Connection::connect();
        $q = "DELETE FROM forum WHERE `forum`.`id` = $id";
        $db->query($q);
    }

    public static function getMatterByForum($id) {
        $db = Connection::connect();
        $q = "SELECT * FROM matter where forum='$id'";
        $result = $db->query($q);
        $Matters = array();

        while ($row = $result->fetch_assoc()) {
            $Matters[] = new Matter($row['id'], $row['name'],$row['status'],$row['forum']);
        }

        return $Matters;
    }

    public static function typeHandler($id) {
        $forum = ForumRepository::getForumById($id);
        $db = Connection::connect();
        if ($forum->type == 'public') {
            $q = "UPDATE forum set type='private' WHERE id='$id'";
        }else {
            $q = "UPDATE forum set type='public' WHERE id='$id'";
        }
        $db->query($q);
    }
}