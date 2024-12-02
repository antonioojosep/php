<?php
require_once("models/Forum.php");
require_once("models/ForumRepository.php");
require_once("models/User.php");
require_once("models/UserRepository.php");


session_start();

$Forums = ForumRepository::getAllForums();


if (isset($_GET['c'])) {
    require_once("controllers/".$_GET['c']."Controller.php");
}else {
    require_once("views/mainView.phtml");
}