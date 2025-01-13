<?php
if (isset($_GET['create'])) {
    if (isset($_POST['add'])) {
        CompanyRepository::addCompany($_POST['nif'], $_POST['name'], $_POST['address'], $_POST['tutor'], $_POST['telephone'], $_POST['email']);
        header('Location: index.php?c=company');
        exit();
    }
    require_once ("./views/createCompanyView.phtml");
    exit();
}
if (isset($_GET['id'])) {
    $company = CompanyRepository::getCompanyByNif($_GET['id']);
    require_once ("./views/companyView.phtml");
    exit();
}
if (isset($_GET['edit'])) {
    if (isset($_POST['edit'])) {
        CompanyRepository::updateCompany($_POST['id'], $_POST['nif'], $_POST['name'], $_POST['address'], $_POST['tutor'], $_POST['telephone'], $_POST['email']);
        header('Location: index.php?c=company');
        exit();
    }
    $company = CompanyRepository::getCompanyByNif($_GET['edit']);
    require_once ("./views/updateCompanyView.phtml");
    exit();
}
if (isset($_GET['delete'])) {
    CompanyRepository::deleteCompany($_GET['delete']);
    header('Location: index.php?c=user&listCompany');
    exit();
}