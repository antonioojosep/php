<?php
if (isset($_GET['id'])) {
    $Matters = ForumRepository::getMatterByForum($_GET['id']);
    $forum = ForumRepository::getForumById($_GET['id']);
    require_once("views/forumView.phtml");
}