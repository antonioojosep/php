<?php
require_once("models/User.php");
require_once("models/UserRepository.php");
require_once("models/Product.php");
require_once("models/ProductRepository.php");

session_start();

if (isset($_GET['c'])) {
    require_once("controllers/".$_GET['c']."Controller.php");
} else if (!isset($_SESSION['user'])) {
    require_once("controllers/userController.php");
    require_once("controllers/listController.php");
}

require_once("controllers/listController.php");