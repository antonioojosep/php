<?php
//cargamos el modelo
require_once 'models/User.php';
require_once 'models/UserRepository.php';


require_once 'models/Song.php';
require_once 'models/SongRepository.php';


require_once 'models/PlayList.php';
require_once 'models/PlayListRepository.php';

session_start();

if (isset($_GET['c'])) {
    require_once('controllers/' . $_GET['c'] . 'Controller.php');
}


if (!isset($_SESSION['user']))
    // cargar la vista
    require_once 'views/loginView.phtml';
else {
    require_once 'views/mainView.phtml';
}
