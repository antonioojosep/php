<?php
$username = $_SESSION['user']->getUsername();
$cashorder = CashOrderRepository::getNotCompletedCashOrder($username);

if (isset($_POST['buy'])) {
    if ($cashorder) {
        ProductLineRepository::addProductLine($_POST['id_product'],$cashorder->getId(),$_POST['name'],$_POST['price'],$_POST['amount']);
        
    }else {
        CashOrderRepository::createCashOrder($username);
        $cashorder = CashOrderRepository::getNotCompletedCashOrder($username);
        ProductLineRepository::addProductLine($_POST['id_product'],$cashorder->getId(),$_POST['name'],$_POST['price'],$_POST['amount']);
    }
    header("Location: index.php");
    exit();
}

if ($cashorder) {
    $lines = ProductLineRepository::gelAllsProductLines($cashorder->getId());
}else{
    CashOrderRepository::createCashOrder($username);
    $cashorder = CashOrderRepository::getNotCompletedCashOrder($username);
    $lines = ProductLineRepository::gelAllsProductLines($cashorder->getId());
}
$id_cashorder = $cashorder->getId();
if (isset($_GET['final'])) {
    $result = CashOrderRepository::closeCashOrder($_GET['final']);
    header("Location: index.php");
}


require_once("views/cashOrderView.phtml");