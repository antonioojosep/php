<?php
class PracticeRepository{
    public static function createPractice($user, $company, $teacher, $start , $end){
        try {
            $db = Connection::connect();
            $q = "INSERT INTO practice (user_id, company_nif, teacher_id, start, end) VALUES ('$user', '$company', '$teacher', '$start', '$end')";
            $q2 = "UPDATE practice SET company_nif = '$company', teacher_id = '$teacher', start = '$start', end = '$end' WHERE user_id = '$user'";
            if ($db->query($q)) {
                return true;
            }else {
                $db->query($q2);
            return true;
            }
        } catch (Exception $e) {
            return false;
        }
    }

    public static function getAllPractices(){
        try {
            $db = Connection::connect();
            $q = "SELECT * FROM practice";
            $result = $db->query($q);
            $practices = array();
            
            while ($row = $result->fetch_assoc()) {
                $practice = new Practice($row['id'], $row['user_id'], $row['company_nif'], $row['teacher_id'], $row['start'], $row['end']);
                $practices[] = $practice;
            }
            usort($practices, function($a, $b) {
                return $b->getDateStart() <=> $a->getDateStart();
            });
            return $practices;
            
        } catch (Exception $e) {
            return false;
        }
    }

    public static function deletePractice(int $id) {
        try {
            $db = Connection::connect();
            $q = "DELETE FROM practice WHERE id = '$id'";
            $db->query($q);
            return true;
            
        } catch (Exception $e) {
            return false;
        }
    }

    public static function getPracticeByUserId(int $id){
        try {
            $db = Connection::connect();
            $q = "SELECT * FROM practice WHERE user_id = '$id'";
            $result = $db->query($q);
            $practice = $result->fetch_assoc();
            $practices = array();
            
            while ($row = $result->fetch_assoc()) {
                $practice = new Practice($row['id'], $row['user_id'], $row['company_nif'], $row['teacher_id'], $row['start'], $row['end']);
                $practices[] = $practice;
            }
            
            return $practices;
            
        } catch (Exception $e) {
            return false;
        }
    }

    public static function getPracticeByTeacherId(int $id) {
        try {
            $db = Connection::connect();
            $q = "SELECT * FROM practice WHERE teacher_id = '$id'";
            $result = $db->query($q);
            $practices = array();
            
            while ($row = $result->fetch_assoc()) {
                $practice = new Practice($row['id'], $row['user_id'], $row['company_nif'], $row['teacher_id'], $row['start'], $row['end']);
                $practices[] = $practice;
            }
            return $practices;
            
        } catch (Exception $e) {
            return false;
        }
    }

    public static function searchPractice(int $user_id){
        try {
            $db = Connection::connect();
            $q = "SELECT * FROM practice WHERE user_id = '$user_id' ";
            $result = $db->query($q);
            $practices = array();
            
            while ($row = $result->fetch_assoc()) {
                $practice = new Practice($row['id'], $row['user_id'], $row['company_nif'], $row['teacher_id'], $row['start'], $row['end']);
                $practices[] = $practice;
            }
            return $practices;
            
        } catch (Exception $e) {
            return false;
        }
    }
}