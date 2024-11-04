<?php
if (isset($_GET['addStock'])) {
    ProductRepository::setStock($_POST['id_product'],$_POST['amount']);
    header("Location: index.php");
}

require_once("views/addProductView.phtml");
require_once("helpers/fileHelper.php");

if (isset($_POST['addProduct'])) {
    // Declarar variables
    $name = $_POST['name'];
    $description = $_POST['description'];
    $image = $_FILES['image']['name'];
    $stock =$_POST['stock'];
    $price = $_POST['price'];

    // mover imagen
    FileHelper::fileHandler($_FILES['image']['tmp_name'],"./public/img/". $_FILES['image']['name']);    

    // Añadir a la base de datos
    $añadir = ProductRepository::addProduct($name,$description,$image,$stock,$price);
    header("Location: index.php");
}