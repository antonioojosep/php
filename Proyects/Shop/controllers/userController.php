<?php
require_once("views/loginView.phtml");

if (isset($_POST['login'])) {
    if (!isset($_SESSION['user'])) {
        $user = UserRepository::checkUser($_POST['username'], $_POST['password']);
        if (!is_string($user)) {
            $_SESSION['user'] = $user;
            header("Location: index.php");
        } else {
            echo $user;
        }
    }
}

if (isset($_POST['signin']) && $_SESSION['user']->getType() === "admin") {
    $user = UserRepository::checkUser($_POST['username'], $_POST['password']);
    if (is_object($user) || $user === "Contraseña incorrecta") {
        echo "Usuario ya registrado";
    } else {
        if (UserRepository::addUser($_POST['username'], $_POST['password'], $_POST['type'])) {
            $user = new User($_POST['username'], $_POST['type']);
            header("Location: index.php");
        }
    }
}
