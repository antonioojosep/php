<?php
require_once("views/listView.phtml");

if (isset($_GET['close'])) {
    session_destroy();
    header("Location: index.php");
}