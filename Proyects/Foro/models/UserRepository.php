<?php
class UserRepository {

    public static function getAllUsers () {
        $db = Connection::connect();
        $q = 'SELECT * FROM users';
        try {
            $result = $db->query($q);
            $Users = array();

            while ($row = $result->fetch_assoc()) {
                $Users[] = new User($row['nickname'],$row['avatar'],$row['email'],$row['public']);
            }

            return $Users;
        } catch (Exception $e) {
            return 'Error' . $e;
        }
    }

    public static function addUser($nickname,$password,$email,$avatar,$type) {
        $db = Connection::connect();
        $q = "INSERT INTO `users` (`nickname`, `password`, `email`, `avatar`, `type`) VALUES ('$nickname', '$password', '$email', '$avatar', '$type')";
        try {
            $db->query($q);
        } catch (Exception $e) {
            return 'Error' . $e;
        }
    }

    public static function checkUser($nickname,$password) {
        $db = Connection::connect();
        $q = "SELECT password FROM users WHERE nickname = '$nickname'";
        try {
            $result = $db->query($q);
            if ($result->fetch_column() === $password) {
                return true;
            }else {
                return false;
            }
        } catch (Exception $e) {
            echo $e;
            return false;
        }
    }
}