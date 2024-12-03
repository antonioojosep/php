<?php
if (isset($_GET['add'])) {
    ResponseRepository::addResponse($_POST['response'],$_POST['matter'],$_POST['user']);
    header("Location: index.php?c=matter&id=" . $_POST['matter']);
}
if (isset($_POST['status'])) {
    ResponseRepository::statusHandler($_GET['id'],$_POST['status']);
    header("Location: index.php?c=matter&id=".$_POST['matter']);
}