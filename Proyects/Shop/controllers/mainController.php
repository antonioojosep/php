<?php
require_once("models/User.php");
require_once("models/UserRepository.php");

session_start();

if (isset($_GET['c'])) {
    require_once("controllers/".$_GET['c']."Controller.php");
}
if (!isset($_SESSION['user'])) {
    require_once("controllers/userController.php");
}else {
    require_once("controllers/listController.php");
}