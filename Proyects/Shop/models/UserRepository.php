<?php

class UserRepository {

    public static function getAllUsers()
    {
        $db = Connection::connect();
        $q = "SELECT username FROM users";
        $result = $db->query($q);
        $Users = array();
        while ($row = $result->fetch_assoc()) {;
            $Users[] = new User($row['username']);
        }

        return $Users;
    }

    public static function checkUser($username,$password) {
        $Users = UserRepository::getAllUsers();
        foreach ($Users as $user) {
            if ($user->__getUsername() === $username) {
                $db = Connection::connect();
                $q = "SELECT password FROM Users WHERE username ='$username'";
                $result = $db->query($q);
            if ($result->fetch_assoc()['password'] === $password) {
                return new User($username);
            }else {
                return "Contraseña incorrecta";
            }
            }else {
                return "Usuario no registrado";
            }
        }
    }
}