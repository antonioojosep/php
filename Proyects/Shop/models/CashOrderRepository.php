<?php
class CashOrderRepository {
    public static function getNotCompletedCashOrder($username) {
        $db = Connection::connect();
        $q = "SELECT * FROM cashorder WHERE username = '$username' AND completed = false";
        try {
            $result = $db->query($q);
            while ($row = $result->fetch_assoc()) {
                $cashorder = new CashOrder($row['id'],$row['username']);
                return $cashorder;
            }
        } catch (Exception $e) {
            echo $e;
            return false;
        }
    }

    public static function createCashOrder($username) {
        $db = Connection::connect();
        $q = "INSERT INTO cashorder(username) VALUES ('$username')";
        $db->query($q);
    }
}