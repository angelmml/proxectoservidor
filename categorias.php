<?php
session_start();

$correo = isset($_SESSION['correo']) ? $_SESSION['correo'] : null;
$cod_rol = null;

if ($correo) {
    //Conectamos a base de datos
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "pedidos";
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error){
        die("Error en la conexión a la base de datos: " . $conn->connect_error);
    }
    
    //Consulta
    $query = "SELECT Correo, CodigoRol FROM usuario WHERE Correo = '$correo'";
    $result = $conn->query($query);
    
    if ($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $cod_rol = $row['CodigoRol'];
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MercaXallas</title>
    <link rel="stylesheet" href="css/categorias.css">
</head>

<body>
    <div class="topnav">
        <a href="index.php">Inicio</a>
        <a class="active" href="categorias.php">Categorías</a>
        <a href="ofertas.php">Ofertas</a>
        <?php

        if ($cod_rol == 1){
             echo '<a href="area_personal.php">Xestión</a>';
        }
        // Verificar se o usuario iniciou sesion
        if ($correo) {
            // Sesión iniciada, mostrar opcions de usuario
           
            echo '<a href="pechar_sesion.php">Cerrar Sesión</a>';
        } else {
            // Sesión non iniciada, mostro opción de iniciar sesión
            echo '<a href="login.html">Iniciar Sesión</a>';
        }
        ?>
    </div>
    <div class="centro1">
        <h1>Categorías</h1>
        <div class="categorias">
            <?php
           
            // Conectamos a base de datos
            $servername = "127.0.0.1";
            $username = "root";
            $password = "";
            $dbname = "pedidos";
            $conn = new mysqli($servername, $username, $password, $dbname);
    
            if ($conn->connect_error) {
                die("Error en la conexión a la base de datos: " . $conn->connect_error);
            }
    
            // Consultamos
            $query = "SELECT * FROM categoria WHERE Activo = 1";
            $result = $conn->query($query);
    
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $nombreCategoria = $row['Nombre'];
                    $rutaImagen = $row['RutaIMX'];
    
                    // Mostramos as categorías
                    echo '<div class="categoria">';
                    echo '<div class="tarjeta">';
                    echo '<img src="' . $rutaImagen . '" alt="' . $nombreCategoria . '">';
                    echo '<div class="texto">';
                    echo '<h2>' . $nombreCategoria . '</h2>';
                    echo '<a href="productos.php?categoria=' . urlencode($nombreCategoria) . '">Acceder a categoría</a><br>';
                    if ($cod_rol == 1){
                        echo '<a href=engade_producto.php><h3>Gestión de productos</h3></a><br>';
                    }
                    echo '</div>'; 
                    echo '</div>'; 
                    echo '</div>'; 
                }
            } else {
                echo "Sin categorías disponibles";
            }
            ?>
        </div>
    </div>
</body>

</html>
