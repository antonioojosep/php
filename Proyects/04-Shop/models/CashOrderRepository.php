<?php
class CashOrderRepository {
    public static function getNotCompletedCashOrder($username) {
        $db = Connection::connect();
        $q = "SELECT * FROM cashorder WHERE username = '$username' AND status = 'open'";
        try {
            $result = $db->query($q);
            $cashorder = array();
            while ($row = $result->fetch_assoc()) {
                $cashorder = new CashOrder($row['id'],$row['username'],$row['date'],$row['status'],$row['address']);
            }
            return $cashorder;
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

    public static function setStatus($id_cashorder,$status) {
        $db = Connection::connect();
        $q = "UPDATE cashorder set status = '$status' WHERE id = '$id_cashorder'";
        try {
            $db->query($q);
        } catch (Exception $e) {
            echo $e;
            return $e;
        }
    }

    public static function setAddress($id_cashorder,$address) {
        $db = Connection::connect();
        $q = "UPDATE cashorder set address = '$address' WHERE id = '$id_cashorder'";
        try {
            $db->query($q);
        } catch (Exception $e) {
            echo $e;
            return $e;
        }
    }

    public static function getCompletedCashOrder($username) {
        $db = Connection::connect();
        $q = "SELECT * FROM cashorder WHERE username = '$username' AND status != 'open'";
        try {
            $result = $db->query($q);
            $cashorder = array();
            while ($row = $result->fetch_assoc()) {
                $cashorder[] = new CashOrder($row['id'],$row['username'],$row['date'],$row['status'],$row['address']);
            }
            return $cashorder;
        } catch (Exception $e) {
            echo $e;
            return false;
        }
    }

    public static function getAllsCompletedCashOrder() {
        $db = Connection::connect();
        $q = "SELECT * FROM cashorder WHERE status != 'open'";
        try {
            $result = $db->query($q);
            $cashorder = array();
            while ($row = $result->fetch_assoc()) {
                $cashorder[] = new CashOrder($row['id'],$row['username'],$row['date'],$row['status'],$row['address']);
            }
            return $cashorder;
        } catch (Exception $e) {
            echo $e;
            return false;
        }
    }
}