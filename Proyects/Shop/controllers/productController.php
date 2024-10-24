<?php
require_once("views/addProductView.phtml");
if (isset($_POST['addProduct'])) {
    $añadir = ProductRepository::addProduct($_POST['name'],$_POST['description'],$_POST['image'],$_POST['stock'],$_POST['price']);
    header("Location: index.php");
    return $añadir;
}