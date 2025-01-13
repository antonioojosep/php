<?php
session_start();
//Conexión a la base de datos
$db = new mysqli('localhost', 'root', '', 'blog');

//Obtener articulos
function obtener_articulos($db) {
    $q = " SELECT * FROM articulo WHERE visible = true ";
    $result = $db->query($q);
    $articulos = array();
    while ($row = $result->fetch_assoc()) {
        $articulos[] = $row;
    }
    return $articulos;
}

//Obtener comentarios
function obtener_comentarios($db) {
    $q_coment = " SELECT * FROM comentario; ";
    $result = $db->query($q_coment);
    $comentarios = array();
    while ($row = $result->fetch_assoc()) {
        $comentarios[] = $row;
    }
    return $comentarios;
}



//Inicio de sesion
if (isset($_POST['login'])) {
    if (isset($_POST['user']) && isset($_POST['password'])) {
        $username = $_POST['user'];
        $password = $_POST['password'];
        $q = "SELECT * FROM login WHERE username = '$username'";
        $result = $db->query($q);
        $data = $result->fetch_assoc();
        if ($password == $data['password']) {
            $_SESSION['user'] = $username;
            $_SESSION['password'] = $password;
            $_SESSION['login'] = $_POST['login'];
        } else {
            echo "Datos incorrectos";
        }
    } else {
        echo "Usuario no registrado";
    }
}

//Cerrar Sesión
if (isset($_POST['close'])) {
    session_destroy();
    header("Location: " . $_SERVER['PHP_SELF']); // Redirigir a la misma página
    //exit();
}

//Ocultar articulo
if (isset($_POST['ocultar']) && isset($_POST['id'])) {
    $q_hide = "UPDATE articulo SET visible = false WHERE id = '" . $_POST['id'] . "'";
    $db->query($q_hide);
    $articulos = obtener_articulos($db);
}

if (isset($_POST['mostrar_ocultos'])) {
    $q_hide = "UPDATE articulo SET visible = true WHERE id_user = '" . $_SESSION['user'] . "'";
    $db->query($q_hide);
    $articulos = obtener_articulos($db);
}

if (isset($_POST['comentario'])) {
   $q_coment = "INSERT INTO comentario (texto, id_usuario, id_articulo) 
                VALUES ('" . $_POST['comentario'] . "', '" . $_SESSION['user'] . "', '". $_POST['id_comentario'] ."');";
    $db->query($q_coment);
    $articulos = obtener_articulos($db);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Blog de Antonio</title>
</head>

<body>
    <header>
        <h1>Blog de Antonio</h1>
        <ul>
            <li>Inicio</li>
            <li>Acerca de</li>
            <li>Contacto</li>
        </ul>
    </header>
    <?php
    if (!isset($_SESSION['user'])) {
        echo "<form method='post' class='inicio'>";
        echo "<input type='text' name='user' placeholder='Usuario' required>";
        echo "<input type='password' name='password' placeholder='Contraseña' required>";
        echo "<input type='submit' name='login' value='Iniciar Sesión'>";
        echo "</form>";
    }
    if (isset($_SESSION['user'])) {
        echo "<form method='post' class='inicio'>";
        echo "<input type='submit' name='close' value='Cerrar Sesión'>";
        echo "<input type='submit' name='mostrar_ocultos' value='Mostrar Ocultos'>";
        echo "</form>";
    }

    ?>

    <div>
        <?php
        $articulos = obtener_articulos($db);
        foreach($articulos as $articulos){
            echo "<article>";
        echo "<img src='./img/" . $articulos['imagen'] . "' width='150px' >";
        echo "<strong>" . $articulos['fecha'] . "</strong>";
        $comentarios = obtener_comentarios($db);
        echo "<ul title='Comentarios'>";
        foreach($comentarios as $comentarios) {
            if ($comentarios['id_articulo'] === $articulos['id']) {
                echo "<li><strong>" . $comentarios['id_usuario'] . ":</strong>". $comentarios['texto'] ."</li>";
            }
        }
        echo "</ul>";
        echo "<p>" . $articulos['texto'] . "</p>";

        if (isset($_SESSION['login']) && $_SESSION['user'] === $articulos['id_user'] ) {
            echo "<form method='post' action=''>";
            echo "<input type='hidden' name='id' value='" . $articulos['id'] . "'>";
            echo "<input type='submit' name='ocultar' value='Ocultar'>";
            echo "</form>";}
        

        if (isset($_SESSION['login']) && $_SESSION['user'] === $articulos['id_user']) {
            echo "<form method='post' action=''>";
            echo "<input type='text' name='comentario' placeholder='Escribe un comentario' required>";
            echo "<input type='hidden' name='id_comentario' value='" . $articulos['id'] . "'>";
            echo "<input type='submit' name='comentar' value='Comentar'>";
            echo "</form>";
        }
        echo "</article>";
        }
        
        ?>
    </div>

    <footer>
        <h2>
        <?php 
            if (isset($_SESSION['user'])) {
                echo "Bienvenido: " . $_SESSION['user'];
            }else {
                echo "Debes iniciar sesion";
            }
        ?>
        </h2>
    </footer>

</body>

</html>