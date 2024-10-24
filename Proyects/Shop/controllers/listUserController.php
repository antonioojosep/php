<?php
$users = UserRepository::getAllUsers();
$user = $_SESSION['user']->getUsername();
echo "<h1>Usuarios</h1>";
echo "<a href='index.php?user=$user'>home</a>";
foreach ($users as $user) {
    $name = $user->getUsername();
    $type = $user->getType();
    echo "<p><a href='index.php?c=listUser&change=$name'>$name</a>: $type</p>";
}

if (isset($_GET['change'])) {
    $username = $_GET['change'];
    $user = UserRepository::getUserByUsername($username);
    UserRepository::changeType($user);
    header("Location: index.php?c=listUser");
}