<?php
if (isset($_POST['playlist'])) {
    SongPlaylistRepository::addSongTo($_POST['playlistId'],$_POST['songId']);
}
if (isset($_POST['add'])) {
    SongRepository::addSong($_POST['title'],$_POST['author'],$_POST['length'],$_FILES['song']['name']);
    fileHelper::fileHandler($_FILES['song']['tmp_name'],"./public/mp3/".$_FILES['song']['name']);
    header("Location: index.php?c=song");
    exit();
}
if (isset($_POST['search'])) {
    $Songs = SongRepository::searchSong($_POST['title'],$_POST['author']);
    require_once("views/songView.phtml");
    exit();
}

if (isset($_SESSION['user'])) {
    $Playlists = PlaylistRepository::getAllPlaylistByUser($_SESSION['user']);
}

$Songs = SongRepository::searchSong('','');
require_once("views/songView.phtml");
exit();