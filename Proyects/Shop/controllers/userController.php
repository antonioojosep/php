<?php
require_once("views/loginView.phtml");

if (isset($_POST['login'])) {
    $user = UserRepository::checkUser($_POST['username'],$_POST['password']);
    if (is_object($user)) {
        $_SESSION['user']=$user;
        header("Location: index.php");
    }else {
        echo $user;
    }
}