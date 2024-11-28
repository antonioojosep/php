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
    ?>

</body>
</html>
