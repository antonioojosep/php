<?php
require_once('helpers/fileHelper.php');

// Añadir película
if (isset($_GET['newMovie'])) {
    require_once('views/newMovie.phtml');
    die();
}

if (isset($_POST['addMovie'])) {
    if (isset($_POST['title'])  && isset($_POST['year'])) {
        if (isset($_FILES['poster']['name'])) {
            fileHelper::fileHandler($_FILES['poster']['tmp_name'], 'public/img/' . $_FILES['poster']['name']);
        }
        $title = $_POST['title'];
        $poster = $_FILES['poster']['name'];;
        $year = $_POST['year'];
        $genero = $_POST['genero'];
        MovieRepository::addMovie($title, $year, $poster, $genero);
        header("Location: index.php");
    }
}

// Eliminar película
if (isset($_POST['eliminar'])) {
    MovieRepository::deleteMovie($_POST['id_movie']);
    header("Location: index.php");
}

// Click en película
if (isset($_GET['eachMovie'])) {
    require_once('views/eachMovie.phtml');
    die();
}

// Click en usuario
if (isset($_GET['eachUser'])) {
    require_once('views/eachUser.phtml');
    die();
}

// Añadir comentario
if (isset($_POST['comentario'])) {
    $comentario = new Comment($_SESSION['user']->getUsername(), $_POST['id_movie'], $_POST['comentario']);
    CommentRepository::addComment($comentario);
    header("Location: index.php");
}

// Añadir a favoritos
try {
    if (isset($_POST['favoritos'])) {
        FavoritesRepository::addFavorite($_SESSION['user']->getUsername(), $_POST['id_movie']);
        header("Location: index.php");
    }
		
} catch (Exception $e) {
    echo "Esta película ya está en favoritos.";
}

// Buscar película
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $movies = MovieRepository::getMoviesByTitle($search);
} else {
    $movies = MovieRepository::getMovies();
}


