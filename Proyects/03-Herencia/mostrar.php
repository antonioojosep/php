<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    require_once("Vehiculo.php");
    $vehiculo = new Vehiculo("negro",1500);
    $vehiculo->circula();
    $vehiculo->añadir_persona(70);
    echo $vehiculo->getPeso();
    echo "</br>";

    $coche = new Coche("verde",1400,4);
    $coche->añadir_persona(65);
    $coche->añadir_persona(65);
    echo $coche->getPeso();
    echo $coche->getColor();
    $coche->repintar("rojo");
    $coche->añadir_cadenas_nieve(2);
    echo "</br>";
    echo $coche->getColor();
    echo $coche->getCad();

    $dos_ruedas = new Dos_ruedas("negro",120)
    ?>

</body>
</html>
