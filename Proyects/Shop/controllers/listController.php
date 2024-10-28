<?php
// Listar productos
$products = ProductRepository::getAllProducts();

require_once("views/listView.phtml");