<?php
if (isset($_GET['id'])) {
    $playlist = PlaylistRepository::getPlaylistById($_GET['id']);
    $Songs = SongPlaylistRepository::getAllSongByPlaylist($_GET['id']);
    require_once("views/playlistView.phtml");
    exit();
}
if (isset($_GET['fav'])) {
    FavsRepository::addFav($_GET['fav'],$_SESSION['user']);
    header("Location: index.php");
    exit();
}
if (isset($_POST['add'])) {
    PlaylistRepository::addPlaylist($_POST['title'],$_SESSION['user']);
}
if (isset($_POST['search'])) {
    $Playlists = PlaylistRepository::searchPlaylist($_POST['title'],$_SESSION['user']);
    require_once("views/mainView.phtml");
    exit();
}