<?php

require_once "helpers/fileHelper.php";

if (isset($_GET['addSong'])) {
    //comprobar todos los input

    if (isset($_FILES['mp3']['name'])) {
        FileHelper::fileHandler($_FILES['mp3']['tmp_name'], 'public/mp3/' . $_FILES['mp3']['name']);
    }

    if (isset($_POST['title']) && isset($_POST['author']) && isset($_POST['duration'])) {
        $songId = SongRepository::addSong($_POST['title'], $_POST['author'], $_POST['duration'], $_FILES['mp3']['name'], $_SESSION['user']->getId());

        header('Location: index.php?c=song&detail=' . $songId);
    }
}

if (isset($_GET['detail'])) {
    $song = SongRepository::getSongById($_GET['detail']);
    require_once 'views/songView.phtml';
    exit();
}

if (isset($_POST['addToPlaylist'])) {


    if (isset($_POST['playlist']) && isset($_POST['song'])) {

        $playlist = PlayListRepository::getPlaylistByName($_POST['playlist']);
        PlayListRepository::addSongToPlaylist($playlist->getId(), $_POST['song']);
    }

    header('Location: index.php?c=playlist&detail=' . $playlist->getId());
}

if (isset($_GET['searchSong'])) {

    $songs = SongRepository::searchSongs($_POST['search']);
    require_once 'views/searchSongsView.phtml';
    exit();
}
