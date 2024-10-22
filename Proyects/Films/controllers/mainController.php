<?php
//cargamos el modelo
require_once('models/Movie.php');
require_once('models/MovieRepository.php');
require_once('models/User.php');
require_once('models/UserRepository.php');
require_once('models/Comment.php');
require_once('models/CommentRepository.php');
require_once('models/Favorites.php');
require_once('models/FavoritesRepository.php');


session_start();


if (isset($_GET['c'])) {
    require_once('controllers/' . $_GET['c'] . 'Controller.php');
}else {
    require_once('controllers/movieController.php');
}


if (!isset($_SESSION['user'])){
    // cargar la vista
    require_once("views/loginView.phtml");
    }
else    require_once 'views/ListView.phtml';
