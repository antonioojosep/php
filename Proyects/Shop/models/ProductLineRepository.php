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

    public static function getAmountByProduct($id_product,$username) {
        $products = ProductLineRepository::gelAllsProductLines($username);
        $productsId = array();
        $amount = 0;
        foreach ($products as $product) {
            if ($product->getIdProduct() == $id_product) {
                $productsId[] = $product;
            }
        }
        foreach ($productsId as $product) {
            $amount += $product->getAmount();
        }
        return $amount;
    }

    public static function gelAllsCompletedProductLines($username) {
        $cashorders = CashOrderRepository::getCompletedCashOrder($username);
        if (!$cashorders) {
            return false;
        }
        $productlines = array();
        $db = Connection::connect();
        foreach ($cashorders as $cashorder) {
            $id_cashorder = $cashorder->getId();
            $q = "SELECT * FROM productline WHERE id_cashorder = '$id_cashorder'";
            $result = $db->query($q);
            while ($row = $result->fetch_assoc()) {
                $productlines[] = new ProductLine($row['id_product'],$row['id_cashorder'],$row['name'],$row['amount'],$row['price']);
            }
        }
            return $productlines;
    }

}