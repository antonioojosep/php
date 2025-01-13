<?php
if (isset($_GET['signin'])) {
    if (isset($_POST['signin'])) {
        UserRepository::addUser($_POST['username'],$_POST['password'],$_POST['email']);
        header("Location: index.php");
    }
    require_once("views/signinView.phtml");
    exit();
}
if (isset($_GET['login'])) {
    if (isset($_POST['login'])) {
        $user = UserRepository::checkUser($_POST['username'],$_POST['password']);
        if (is_object($user))
        {
            $_SESSION['user'] = $user;
            header("Location: index.php");
        }else if (!$user) {
            echo "usuario incorrecto";
        } else {
            echo "Contraseña incorrecta";
        }
    }
    require_once("views/loginView.phtml");
    exit();
}
if (isset($_GET['close'])) {
    session_destroy();
    header("Location: index.php");
}