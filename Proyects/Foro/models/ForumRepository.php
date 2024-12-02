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
                $Forums[] = new Forum($row['name'], $row['public']); 
            }

            return $Forums;
        } catch (Exception $e) {
            echo "Error getAllForums " . $e;
        }
    }

    public static function createForum() {

    }
}