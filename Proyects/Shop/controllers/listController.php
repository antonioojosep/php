<?php
require_once("views/listView.phtml");
$admin = $_SESSION['user']->getType() === "admin";

// Cerrar sesión
if (isset($_GET['close'])) {
    session_destroy();
    header("Location: index.php");
}

if (isset($_SESSION['user'])) {
    echo "<a href='index.php?close'>Cerrar</a>";
    echo "<h1>" . $_SESSION['user']->getUsername() . "</h1>";

    if ($admin) {
        echo "<a href='index.php?c=product'>Añadir producto</a></br>";
        echo "<a href='index.php?c=user'>Añadir usuario</a></br>";
        echo "<a href='index.php?c=listUser'>Gestionar usuario</a></br>";
    }
}

// Listar productos
$products = ProductRepository::getAllProducts();
foreach ($products as $product) {
    // Declaración de variables
    $name = $product->getName();
    $img = $product->getImage();
    $description = $product->getDescription();
    $stock = $product->getStock();
    $price = $product->getPrice();

    // Mostrar
    echo "<div>";
    echo "<img src='./public/img/$img' alt='Imagen de producto' width='100px'>";
    echo "<h3>$name</h3>";
    echo "<p><strong>$stock und</strong>  $price €</p>";
    echo "<p>$description</p>";
    // if ($admin) {
    //     echo 
    //     "<form>
    //         <input type='number'
    //     </form>"
    // }
    echo "</div>";
}
