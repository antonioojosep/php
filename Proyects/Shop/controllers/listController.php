<?php
// Listar productos
$products = ProductRepository::getAllProducts();

// LLamar a la vista
require_once("views/listView.phtml");