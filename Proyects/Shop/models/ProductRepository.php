<?php
class ProductRepository
{
    public static function getAllProducts()
    {
        $db = Connection::connect();
        $q = "SELECT * FROM products";
        $result = $db->query($q);
        $products = array();

        while ($row = $result->fetch_assoc()) {
            $products[] = new Product($row['id'], $row['name'], $row['description'], $row['image'], $row['stock'], $row['price']);
        }

        return $products;
    }

    public static function addProduct($name, $description, $image, $stock, $price)
    {
        try {
            $db = Connection::connect();
            $q = "INSERT INTO products (name,description,image,stock,price) VALUES ('$name','$description','$image','$stock','$price')";
            $db->query($q);
            return $db->insert_id;
        } catch (Exception $e) {
            return $e;
        }
    }
}
