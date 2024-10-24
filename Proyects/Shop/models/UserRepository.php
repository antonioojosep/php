<?php

class UserRepository
{

    public static function getAllUsers()
    {
        $db = Connection::connect();
        $q = "SELECT username, type FROM users";
        $result = $db->query($q);
        $Users = array();
        while ($row = $result->fetch_assoc()) {;
            $Users[] = new User($row['username'], $row['type']);
        }

        return $Users;
    }

    public static function checkUser($username, $password)
    {
        $Users = UserRepository::getAllUsers();
        foreach ($Users as $user) {
            if ($user->__getUsername() === $username) {
                $db = Connection::connect();
                $q = "SELECT * FROM users WHERE username ='$username'";
                $result = $db->query($q);
                $data = $result->fetch_assoc();
                if ($data['password'] === $password) {
                    return new User($data['username'], $data['type']);
                } else {
                    return "Contraseña incorrecta";
                }
            }
        }
        return "Usuario no registrado";
    }

    public static function addUser($username, $password, $type)
    {
        try {
            $db = Connection::connect();
            $q = "INSERT INTO users(username,password,type) VALUES ('$username', '$password','$type')";
            $db->query($q);
            return true;
        } catch (Exception $e) {
            echo $e;
            return false;
        }
    }
}
