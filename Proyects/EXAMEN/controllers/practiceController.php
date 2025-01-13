<?php
if (isset($_GET['edit'])) {
    $user = UserRepository::getUserById($_GET['edit']);
    require_once("./views/editPracticeView.phtml");
    if (isset($_POST['asign'])) {
        if (PracticeRepository::createPractice($_GET['edit'], $_POST['company'], $_POST['teacher'], $_POST['start'], $_POST['end'])) {
            header('Location: index.php?c=user&username='.$user->getUsername());
            exit();
        }
        echo "El usuario ya a estado en la empresa";
    }
    exit();
}

if (isset($_GET['list'])) {
    $Practices = PracticeRepository::getAllPractices();
    require_once("./views/listPracticesView.phtml");
    exit();
}

if (isset($_GET['delete'])) {
    if (PracticeRepository::deletePractice($_GET['delete'])) {
        header('Location: index.php?c=practice&list');
        exit();
    }else {
        echo "No se ha podido eliminar la práctica";
    }
    exit();
}

if(isset($_GET['search'])) {
    $Practices = PracticeRepository::searchPractice(UserRepository::getUserByUsername($_GET['search'])->getId());
    require_once("./views/listPracticesView.phtml");
    exit();
}