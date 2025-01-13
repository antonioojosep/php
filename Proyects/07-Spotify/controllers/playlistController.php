<?php

if (isset($_GET['detail'])) {
    $pl = PlayListRepository::getPlayListById($_GET['detail']);

    require_once 'views/playlistView.phtml';
    exit();
}

if (isset($_GET['addPlaylist'])) {

    PlayListRepository::createPlaylist($_POST['name'], $_SESSION['user']->getId());
    header('Location: index.php');
}
