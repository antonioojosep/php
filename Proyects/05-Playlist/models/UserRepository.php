<?php
class UserRepository
{
    public static function getAllUsers() : array
    {
        $db = Connection::connect();
        $q = "SELECT * FROM users";
        $result = $db->query($q);
        $Users = array();

        while ($row = $result->fetch_assoc()) {
            $Users[] = new User($row['id'],$row['username'],$row['email'],$row['role']);
        }
        return $Users;
    }

    public static function addUser(string $username, string $password, string $email)
    {
        $db = Connection::connect();
        $q = "INSERT INTO users (`username`,`password`,`email`) VALUES ('$username','$password','$email')";
        try {
            $db->query($q);
        } catch (Exception $e) {
            throw $e;
        }
        
    }

    public static function checkUser(string $username, string $password)
    {
        $db = Connection::connect();
        $q = "SELECT * FROM users WHERE username = '$username'";
        $result = $db->query($q);
        $data = $result->fetch_assoc();
        if (isset($data)) {
            if ($data['password'] == $password) {
                return new User($data['id'],$data['username'],$data['email'],$data['role']);
            }else {
                return true;
            }
        } else {
            return false;
        }       
    }


    public static function getUserByUserId($userId): User
    {
        $db = Connection::connect();
        $q = "SELECT * FROM users WHERE id = '$userId'";
        $result = $db->query($q);
        $data = $result->fetch_assoc();
        return new User($data['id'],$data['username'],$data['email'],$data['role']);
    }
}