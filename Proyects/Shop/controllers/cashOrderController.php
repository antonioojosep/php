<?php
$username = $_SESSION['user']->getUsername();
$lines = ProductLineRepository::gelAllsProductLines($username);
$cashorder = CashOrderRepository::getNotCompletedCashOrder($username);
$id_cashorder = $cashorder->getId();

// Comprar
if (isset($_POST['buy'])) {
    $amount = ProductLineRepository::getAmountByProduct($_POST['id_product'],$username) + $_POST['amount'];
    if ($amount<=ProductRepository::getProductById($_POST['id_product'])->getStock()) {
        ProductLineRepository::addProductLine($_POST['id_product'],$id_cashorder,$_POST['name'],$_POST['price'],$_POST['amount']);
        header("Location: index.php");
        exit();
    }else {
        echo"<p>No hay tanto stock</p>";
    }
    
}

// Finalizar pedido
if (isset($_GET['final'])) {
    $id_cashorder = $_GET['final'];
    foreach ($lines as $line) {
        $id = $line->getIdProduct();
        $amount = ProductRepository::getProductById($id)->getStock() - $line->getAmount();
        if ($amount>=0) {
            ProductRepository::setStock($id,$amount);
            if (isset($_POST['address'])) {
                CashOrderRepository::setAddress($id_cashorder,$_POST['address']);
            }
            if (isset($_POST['method']) && $_POST['method']=='transfer') {
                CashOrderRepository::setStatus($id_cashorder,'closed');
                header("Location: index.php");
            }elseif (isset($_POST['method']) && $_POST['method']=='card') {
                echo "
                    <form action='index.php?c=cashOrder&&final=$id_cashorder' method='post'>
                        <input type='text' name='card' placeholder='Número de tarjeta' id='card' required>
                        <input type='submit' name='card' value='Pagar'>
                    </form>
                ";
                die();
            }elseif (isset($_POST['card'])) {
                CashOrderRepository::setStatus($id_cashorder,'paid');
                header("Location: index.php");
            }
        }else {
            echo"<p>Demasiados productos</p>";
        }
    } 
}


require_once("views/cashOrderView.phtml");