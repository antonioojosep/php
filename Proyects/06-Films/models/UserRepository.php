<?php

class UserRepository
{

    public static function getUsers()
    {
        $db = Connection::connect();
        $q = "SELECT * FROM users";
        $result = $db->query($q);
        $users = array();
        while ($row = $result->fetch_assoc()) {
            $users[] = new User($row['username'], $row['avatar']);
        }

        return $users;
    }

    public static function checkUsers($username, $password)
    {
        $db = Connection::connect();
        $users = UserRepository::getUsers();
        foreach ($users as $user) {
            if ($user->getUsername() === $username) {
                $q = "SELECT * FROM users WHERE username= '$username' AND password = '$password'";
                $result = $db->query($q);
                if ($user = $result->fetch_assoc()) {
                    return new User($user['username'], $user['avatar']);
                }
                return false;
            }
        }
    }

    public static function addUser($username, $avatar, $password)
    {
        $db = Connection::connect();
        $q = "INSERT INTO users (username, avatar, passsword) VALUES ('$username', '$avatar', '$password')";
        $db->query($q);
        return $db->insert_id;
    }
}
