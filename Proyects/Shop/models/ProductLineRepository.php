<?php
class ProductLineRepository {

    public static function addProductLine($id_product,$id_cashorder,$name,$price,$amount) {
        $db = Connection::connect();
        $q = "INSERT INTO productline(id_product,id_cashorder,name,price,amount) 
                VALUES ('$id_product','$id_cashorder','$name','$price','$amount')";

        try {
            $db->query($q);
            return true;
        } catch (Exception $e) {
            echo $e;
            return false;
        }
    }

    public static function gelAllsProductLines($username) {
        $cashorder = CashOrderRepository::getNotCompletedCashOrder($username);
        if (!$cashorder) {
            CashOrderRepository::createCashOrder($username);
            $cashorder = CashOrderRepository::getNotCompletedCashOrder($username);
            ProductLineRepository::gelAllsProductLines($username);
        }
            $id_cashorder = $cashorder->getId();
            $db = Connection::connect();
            $q = "SELECT * FROM productline WHERE id_cashorder = '$id_cashorder'";
            $result = $db->query($q);
            $productlines = array();
            while ($row = $result->fetch_assoc()) {
                $productlines[] = new ProductLine($row['id_product'],$row['id_cashorder'],$row['name'],$row['amount'],$row['price']);
            }
            return $productlines;
        
    }
}