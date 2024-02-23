<?php
session_start();
if (!isset($_SESSION['correo'])) {
    header("Location: login.html");
    exit();
}

$correo = $_SESSION['correo'];
        //Conectamos a base de datos
        $servername = "127.0.0.1";
        $username = "root";
        $password = "";
        $dbname = "pedidos";
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error){
            die("Error na conexión a base de datos:". $conn->connect_error);
        }
        //Consulta
        $query = "SELECT Correo, CodigoRol from usuario where Correo = '$correo'";
        $result = $conn -> query($query);

        if ($result->num_rows> 0){
                $row = $result->fetch_assoc();
                $nom_correo = $row['Correo'];
                $cod_rol = $row['CodigoRol'];
        }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MercaXallas</title>
    <link rel="stylesheet" href="css/xestion_carro.css">
</head>
<body>
    <div class="topnav">
        <a href="index.php">Inicio</a>
        <a href="categorias.php">Categorías</a>
        <a href="ofertas.php">Ofertas</a>
         <?php
        // Verificar usuario iniciou sesión
        if (isset($_SESSION['correo'])) {
        // Sesion iniciada aparece "Xestión" e pechar sesion
        if ($cod_rol == 1){
        echo '<div class="dropdown">';
        echo '<button class="dropbtn">Xestión';
        echo '<i class="fa fa-caret-down"></i>';
        echo '</button>';
        echo '<div class="dropdown-content">';
        echo '<a href="area_personal.php">Xestión usuarios</a>';
        echo '<a href="engade_categoria.php">Xestion categorias</a>';
        echo '<a href="engade_producto.php">Xestion productos</a>';
        echo '</div>';
        echo '</div>';
        }
        echo '<a class="carrito" href="procesa_carro.php">Carrito</a>';
        echo '<a href="pechar_sesion.php">Cerrar Sesión</a>';
        echo '</div>';
       
        } else {
        // Se non, amosamos iniciar sesion
        echo '<a href="login.html">Iniciar Sesión</a>';
    }
    ?>
    <div class="centrado">
        <h3>
            O teu carro
        </h3>
        <table border='1'>
            <tr><th>Producto</th><th>Prezo</th></tr>
        
        </table>

    </div>

