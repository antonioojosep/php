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
            if ($user->getUsername() === $username) {
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

    public static function changeType(User $user)
    {
        $username = $user->getUsername();
        $db = Connection::connect();
        if ($user->getType()==="admin") {
            $q = "UPDATE users SET type='user' WHERE username = '$username'";
        }else {
            $q = "UPDATE users SET type='admin' WHERE username = '$username'";
        }
        $db->query($q);
    }

    public static function getUserByUsername($username) {
        $users = UserRepository::getAllUsers();
        foreach ($users as $user) {
            if ($user->getUsername()===$username) {
                return $user;
            }
        }
    }

    public static function getBestUser() {
        $db = Connection::connect();
        $q = "
        SELECT 
            users.username,
            users.type,
            SUM(productline.amount * productline.price) AS total_spent
        FROM 
            users
        JOIN
            cashorder ON users.username = cashorder.username
        JOIN 
            productline ON cashorder.id = productline.id_cashorder
        WHERE 
            cashorder.status != 'open'
        GROUP BY 
            users.username
        ORDER BY 
            total_spent DESC
        LIMIT 1;";
        $result = $db->query($q);
        $bestUser = array();
        while ($row = $result->fetch_assoc()) {;
            $bestUser[] = new User($row['username'],$row['type']);
            $bestUser[] = $row['total_spent'];
        }

        return $bestUser;
    }
}
