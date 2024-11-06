<?php
// Listar productos
$products = ProductRepository::getAllProducts();

if (isset($_SESSION['user'])) {
    $admin = $_SESSION['user']->getType() === "admin";
}


// LLamar a la vista
require_once("views/listView.phtml");