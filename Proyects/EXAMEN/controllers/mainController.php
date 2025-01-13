<?php
require_once("./models/User.php");
require_once("./models/UserRepository.php");
require_once("./models/Company.php");
require_once("./models/CompanyRepository.php");
require_once("./models/Practice.php");
require_once("./models/PracticeRepository.php");

session_start();

if (isset($_GET['c'])) {
    require_once("./controllers/" . $_GET['c'] . "Controller.php");
}
if (!isset($_SESSION['user'])) {
    require_once("./views/loginView.phtml");
}else {
    require_once("./views/mainView.phtml");
}