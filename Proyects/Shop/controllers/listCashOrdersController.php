<?php
// Listar pedidos
$cashOrders = CashOrderRepository::getAllsCompletedCashOrder();

// Cambios
if (isset($_GET['change'])) {
    $id = $_GET['change'];
    $status = $_POST['status'];
    switch ($status) {
        case 'closed':
            CashOrderRepository::setStatus($id,$status);
        case 'paid':
            CashOrderRepository::setStatus($id,$status);
        case 'sent':
            CashOrderRepository::setStatus($id,$status);
    }
    header("Location: index.php?c=listCashOrders");
}

// LLamar a la vista
require_once("views/listCashOrdersView.phtml");