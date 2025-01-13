<?php
require_once("views/loginView.phtml");

// Iniciar Sesión
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

// Registrarse
if (isset($_POST['signin'])) {
    $user = UserRepository::checkUser($_POST['username'], $_POST['password']);
    if (is_object($user) || $user === "Contraseña incorrecta") {
        echo "Usuario ya registrado";
    } else {
        if (UserRepository::addUser($_POST['username'], $_POST['password'], "user")) {
            $user = new User($_POST['username'], $_POST['type']);
            header("Location: index.php");
        }
    }
}

// Cerrar sesión
if (isset($_GET['close'])) {
    session_destroy();
    header("Location: index.php");
}
