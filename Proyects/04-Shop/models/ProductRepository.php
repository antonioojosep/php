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

    public static function getProductById($id) {
        $products = ProductRepository::getAllProducts();
        foreach ($products as $product) {
            if ($product->getId() === $id) {
                return $product;
            }
        }
        return false;
    }

    public static function setStock($id,$amount)
    { 
        $db = Connection::connect();
        $q = "UPDATE products SET stock = '$amount' WHERE id = '$id' ";
        $result = $db->query($q);
        return $result;
    }

    public static function getMostSell() {
        $db = Connection::connect();
        $q = "
            SELECT 
                p.id,
                p.name,
                p.description,
                p.image,
                p.stock,
                p.price,
            SUM(pl.amount) AS total_sold
            FROM 
             productline pl
            JOIN 
                products p ON pl.id_product = p.id
            GROUP BY 
                p.id, p.name
            ORDER BY 
                total_sold DESC
            LIMIT 1;
        ";
        $result = $db->query($q);

        $products = array();

        while ($row = $result->fetch_assoc()) {
            $products[] = new Product($row['id'], $row['name'], $row['description'], $row['image'], $row['stock'], $row['price']);
            $products[] = $row['total_sold'];
        }

        return $products;
    }
}
