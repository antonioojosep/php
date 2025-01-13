<?php
class UserRepository
{
    public static function getAllUsers(): array {
        try {
            $db = Connection::connect();
            $q = " SELECT * FROM users";
            $result = $db->query($q);
            $Users = array();

            while ($row = $result->fetch_assoc()) {
                $user = new User($row['id'], $row['username'], $row['password'], $row['role']);
                $Users[] = $user;
            }
            
            
            return $Users;
        } catch (Exception $e) {
            return false;
        }
    }
    public static function checkPassword(string $username, string $password) {
        try {
            $db = Connection::connect();
            $q = "SELECT * FROM users WHERE username = '$username'";
            $result = $db->query($q);
            $user = $result->fetch_assoc();
            if ($user['password'] === $password) {
                return new User($user['id'], $user['username'], $user['role']);
            }
        } catch (Exception $e) {
            return false;
        }
    }

    public static function getUserByUsername(string $username) : User {
        try {
            $db = Connection::connect();
            $q = "SELECT * FROM users WHERE username = '$username' ";
            $result = $db->query($q);
            $data = $result->fetch_assoc();
            return new User($data['id'], $data['username'], $data['role']);
        } catch (Exception $e) {
            return false;
        }
    }

    public static function addUser($username, $password) {
        try {
            $db = Connection::connect();
            $q = "INSERT INTO users (username, password, role) VALUES ('$username', '$password','user')";
            $db->query($q);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public static function changeRole(User $user,string $role) {
        try {
            $db = Connection::connect();
            $q = "UPDATE users SET role = '$role' WHERE id = {$user->getId()}";
            $db->query($q);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public static function getUserByRole(string $role) {
        try {
            $db = Connection::connect();
            $q = "SELECT * FROM users WHERE role = '$role'";
            $result = $db->query($q);
            $users = array();
            while ($row = $result->fetch_assoc()) {
                $users[] = new User($row['id'], $row['username'], $row['role']);
            }
            return $users;
        } catch (Exception $e) {
            return false;
        }
    }

    public static function createPractice($user, $company, $teacher, $start , $end){
        try {
            $db = Connection::connect();
            $q = "INSERT INTO practice (user_id, company_nif, teacher_id, start, end) VALUES ('$user', '$company', '$teacher', '$start', '$end')";
            var_dump($q);
            $db->query($q);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public static function getUserById(int $id) : User {
        try {
            $db = Connection::connect();
            $q = "SELECT * FROM users WHERE id = '$id' ";
            $result = $db->query($q);
            $data = $result->fetch_assoc();
            return new User($data['id'], $data['username'], $data['role']);
        } catch (Exception $e) {
            return false;
        }
    }

}
