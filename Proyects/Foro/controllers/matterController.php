<?php
if (isset($_GET['id'])) {
    $Responses = MatterRepository::getAllResponseByMatter($_GET['id']);
    $matter = MatterRepository::getMatterById($_GET['id']);

    require_once("views/matterView.phtml");
}
if (isset($_POST['status'])) {
    $forum = $_POST['forum'];
    MatterRepository::statusHandler($_GET['status']);
    header("Location: index.php?c=forum&id=$forum");
}
if (isset($_POST['delete'])) {
    $forum = $_POST['forum'];
    MatterRepository::deleteMatter($_GET['status']);
    header("Location: index.php?c=forum&id=$forum");
}
if (isset($_GET['add'])) {
    $forum = $_GET['add'];
    MatterRepository::addMatter($_POST['matter'],$forum);
    header("Location: index.php?c=forum&id=$forum");
}
