<?php
if (isset($_POST['buy'])) {
    $cashorder = CashOrderRepository::getNotCompletedCashOrder($_SESSION['user']);
    if ($cashorder) {
        ProductLineRepository::addProductLine();
    }
    
}