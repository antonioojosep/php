<?php
if (isset($_GET['id'])) {
    $Matters = ForumRepository::getMatterByForum($_GET['id']);
    $forum = ForumRepository::getForumById($_GET['id']);
    require_once("views/forumView.phtml");
}

if (isset($_GET['type'])) {
    ForumRepository::typeHandler($_GET['type']);
    header("Location: index.php?");
}

if (isset($_GET['add'])) {
    ForumRepository::createForum($_POST['forum']);
    header("Location: index.php");
}

if (isset($_GET['delete'])) {
    ForumRepository::deleteForum($_GET['delete']);
    header("Location: index.php");
}
