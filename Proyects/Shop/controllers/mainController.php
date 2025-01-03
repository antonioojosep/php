<?php
require_once("models/User.php");
require_once("models/UserRepository.php");
require_once("models/Product.php");
require_once("models/ProductRepository.php");
require_once("models/CashOrder.php");
require_once("models/CashOrderRepository.php");
require_once("models/ProductLine.php");
require_once("models/ProductLineRepository.php");


session_start();

if (isset($_GET['c'])) {
    require_once("controllers/".$_GET['c']."Controller.php");
} else if (!isset($_SESSION['user'])) {
    require_once("controllers/userController.php");
    require_once("controllers/listController.php");
}else {
    require_once("controllers/listController.php");
}