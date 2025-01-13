<?php
// ----------------------------------- LOGIN, SIGNIN AND LOGOUT --------------------------------
if (isset($_POST['signin'])) {
        UserRepository::addUser($_POST['username'],$_POST['password']);
        $_SESSION['user'] = UserRepository::getUserByUsername($_POST['username']);
        header('Location: index.php');
        exit();
}
if (isset($_POST['login'])) {
    if (UserRepository::checkPassword($_POST['username'],$_POST['password'])) {
        $_SESSION['user'] = UserRepository::getUserByUsername($_POST['username']);
        header('Location: index.php');
        exit();
    }
}
if (isset($_GET['close'])) {
    session_destroy();
    header('Location: index.php');
    exit();
}

// ----------------------------------- LISTS  --------------------------------

if ($_SESSION['user']->getRole() == 'admin' && isset($_GET['listAllUsers'])) {
    $Users = UserRepository::getAllUsers();
    require_once('./views/listUsersView.phtml');
    exit();
}
if (($_SESSION['user']->getRole() == 'teacher' || $_SESSION['user']->getRole() == 'admin') && isset($_GET['listCompany'])) {
    $Companys = CompanyRepository::getAllCompany();
    require_once('./views/listCompanyView.phtml');
    exit();
}

if ($_SESSION['user']->getRole() == 'teacher' && isset($_GET['listUsers'])) {
    $Users = UserRepository::getUserByRole("user");
    require_once('./views/listUsersView.phtml');
    exit();
}

if ($_SESSION['user']->getRole() == 'teacher' && isset($_GET['listTeachers'])) {
    $Users = UserRepository::getUserByRole("teacher");
    require_once('./views/listUsersView.phtml');
    exit();
}

// ----------------------------------- USER  --------------------------------
if (isset($_GET['username'])) {
    $user = UserRepository::getUserByUsername($_GET['username']);
    require_once('./views/userView.phtml');
    exit();
}

// ----------------------------------- CHANGE  --------------------------------

if (isset($_GET['change'])) {
    UserRepository::changeRole(UserRepository::getUserByUsername($_GET['change']),$_POST['role']);
    header('Location: index.php?c=user&username='.$_GET['change']);
    exit();
}

