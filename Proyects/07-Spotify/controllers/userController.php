<?php

if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: index.php');
}

if (isset($_POST['username']) && isset($_POST['password'])) {
    $user = UserRepository::login($_POST['username'], $_POST['password']);
    if ($user) $_SESSION['user'] = $user;
}
