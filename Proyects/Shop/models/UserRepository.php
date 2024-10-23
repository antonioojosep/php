<?php

class UserRepository {

    private $allUsers = array();

    public function __getAllUsers()
    {
        $db = Connection::connect();
        $q = "SELECT * FROM Users";
        $result = $db->query($q);

        while ($row = $result->fetch_assoc()) {
            $this->allUsers = new User($row);
        }

        return $this->allUsers;
    }
}