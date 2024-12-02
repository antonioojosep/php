<?php
require_once("./helpers/FileHelper.php");

if (isset($_GET['login'])) {
    require_once("./views/loginView.phtml");
}
if (isset($_GET['signin'])) {
    require_once("./views/signinView.phtml");
}

if (isset($_POST['login'])) {
    $_SESSION['user'] = $_POST['nickname'];
    header("Location: index.php");
}


if (isset($_POST['signin'])) {
    FileHelper::fileHandler($_FILES['image']['tmp_name'],"./public/img/". $_FILES['image']['name']);
    UserRepository::addUser($_POST['nickname'],$_POST['password'],$_POST['email'],$_FILES['image']['name'],'user');
    header("Location: index.php");
}
