<?php
require_once("views/loginView.phtml");

if (isset($_GET['login'])) {

    if (isset($_POST['login'])) {
        $user = UserRepository::checkUser($_POST['username'],$_POST['password']);
        if (is_object($user)) {
            $_SESSION['user']=$user;
            header("Location: index.php");
        }else {
            echo $user;
        }
    }
    
    if (isset($_POST['signin'])) {
        $user = UserRepository::checkUser($_POST['username'],$_POST['password']);
        if (is_object($user) || $user === "Contraseña incorrecta") {
            echo "Usuario ya registrado";
        }else {
            if (UserRepository::addUser($_POST['username'],$_POST['password'])) {
                $user = new User($_POST['username'],$_POST['password']);
                $_SESSION['user'] = $user;
                header("Location: index.php");
            }
        }
    }
}

