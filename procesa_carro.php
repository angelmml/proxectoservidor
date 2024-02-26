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

//Faise a consulta
$query = "SELECT Correo, CodigoRol from usuario where Correo = '$correo'";
$result = $conn -> query($query);

if ($result->num_rows> 0){
    $row = $result->fetch_assoc();
    $nom_correo = $row['Correo'];
    $cod_rol = $row['CodigoRol'];
}

// Verificar ye configurar o carro na sesion
if (!isset($_SESSION['carrito']) || !is_array($_SESSION['carrito'])) {
    $_SESSION['carrito'] = array();
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
    // Verificar inicio sesion usuario
    if (isset($_SESSION['correo'])) {
        // Se ta mostramos esto
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
<<<<<<< HEAD:xestion_carro.php
        echo '<a class="carrito" href="carrito.php">Carrito</a>';
=======
        echo '<a class="carrito" href="procesa_carro.php">Carrito</a>';
>>>>>>> a7c68951b3d65a70f45060abd62409f3ee822c6f:procesa_carro.php
        echo '<a href="pechar_sesion.php">Cerrar Sesión</a>';
        echo '</div>';
    } else {
        // Se non sesto
        echo '<a href="login.html">Iniciar Sesión</a>';
    }
    ?>
    <div class="centrado">
        <h3>O teu carro</h3>
        <?php
        // Verificar se temos productos no carro
        if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
            echo "<h2>Carrito de Compras</h2>";
            echo "<table border='1'>";
            echo "<tr><th>Código de Producto</th><th>Cantidad</th></tr>";

            // Recorrer productos e meetelos na tabla
            foreach ($_SESSION['carrito'] as $producto) {
                echo "<tr>";
                echo "<td>" . $producto['codProducto'] . "</td>";
                echo "<td>" . $producto['stock'] . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "<p>No hay productos en el carrito.</p>";
        }
        ?>
    </div>
</body>
</html>
