<?php
require_once("./helpers/FileHelper.php");

$Users = UserRepository::getAllUsers();

if (isset($_GET['login'])) {
    require_once("./views/loginView.phtml");

    if (isset($_POST['login'])) {
        if (UserRepository::checkUser($_POST['nickname'], $_POST['password'])) {
            $_SESSION['user'] = $_POST['nickname'];
            header("Location: index.php");
        }else {
            require_once("views/loginView.phtml");
            echo "Contraseña incorrecta";
        }
        
    }
}
if (isset($_GET['signin'])) {
    require_once("./views/signinView.phtml");

    if (isset($_POST['signin'])) {
        FileHelper::fileHandler($_FILES['image']['tmp_name'],"./public/img/". $_FILES['image']['name']);
        UserRepository::addUser($_POST['nickname'],$_POST['password'],$_POST['email'],$_FILES['image']['name'],'user');
        header("Location: index.php");
    }
}
if (isset($_GET['close'])) {
    session_destroy();
    header("Location: index.php");
}
if (isset($_GET['list'])) {
    require_once("views/listUserView.phtml");
}
if (isset($_GET['type'])) {
    UserRepository::typeHandler($_GET['type']);
    header("Location: index.php?c=user&list");
}