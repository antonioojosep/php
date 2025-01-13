<?php
require_once("models/User.php");
require_once("models/UserRepository.php");
require_once("models/Playlist.php");
require_once("models/PlaylistRepository.php");
require_once("models/Song.php");
require_once("models/SongRepository.php");
require_once("models/SongPlaylist.php");
require_once("models/SongPlaylistRepository.php");
require_once("helpers/fileHelper.php");
require_once("models/FavsRepository.php");

session_start();

if (isset($_GET['c'])) {
    require_once("controllers/". $_GET['c'] ."Controller.php");
}

if (isset($_SESSION['user'])) {
    $Playlists = PlaylistRepository::getAllPlaylistByUser($_SESSION['user']);
    $Favs = FavsRepository::getFavsByUser($_SESSION['user']);
}

require_once("views/mainView.phtml");

