<?php
$username = $_SESSION['user']->getUsername();
$lines = ProductLineRepository::gelAllsProductLines($username);
$cashorder = CashOrderRepository::getNotCompletedCashOrder($username);
$id_cashorder = $cashorder->getId();

// Comprar
if (isset($_POST['buy'])) {
    ProductLineRepository::addProductLine($_POST['id_product'],$id_cashorder,$_POST['name'],$_POST['price'],$_POST['amount']);
    header("Location: index.php");
    exit();
}

// Finalizar pedido
if (isset($_GET['final'])) {
    foreach ($lines as $line) {
        ProductRepository::restStock($line->getIdProduct(),$line->getAmount());
    }
    $result = CashOrderRepository::closeCashOrder($_GET['final']);
    header("Location: index.php");
}


require_once("views/cashOrderView.phtml");