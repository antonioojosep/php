<?php
require_once("views/listView.phtml");

if (isset($_GET['close'])) {
    session_destroy();
    header("Location: index.php");
}

$products = ProductRepository::getAllProducts();
foreach ($products as $product) {
    $name = $product->getName();
    $price = $product->getPrice();
    echo "<p><strong>$name :</strong>$price €</p>";
}