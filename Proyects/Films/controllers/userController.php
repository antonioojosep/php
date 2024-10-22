<?php
require_once('models/UserRepository.php');
require_once('controllers/movieController.php');
require_once('controllers/mainController.php');


if (isset($_POST['inicio'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $_SESSION['user'] = UserRepository::checkUsers($username,$password);
    if ($_SESSION['user'] === false) {
        session_destroy();
       
    }
    header("location: index.php");
}

if (isset($_POST['cerrar'])) {
    session_destroy();
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

