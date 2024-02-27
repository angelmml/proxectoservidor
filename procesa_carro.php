<?php
session_start();
if (!isset($_SESSION['correo'])) {
    header("Location: login.html");
    exit();
}

$correo = $_SESSION['correo'];
// Conectamos a base de datos
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "pedidos";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error){
    die("Error en la conexión a la base de datos: " . $conn->connect_error);
}

// Verificamos e configuramos o carro coa sesion
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
        // Se a ten iniciada mostrara esto
        echo '<div class="dropdown">';
        echo '<button class="dropbtn">Xestión';
        echo '<i class="fa fa-caret-down"></i>';
        echo '</button>';
        echo '<div class="dropdown-content">';
        echo '<a href="area_personal.php">Xestión usuarios</a>';
        echo '<a href="engade_categoria.php">Xestión categorías</a>';
        echo '<a href="engade_producto.php">Xestión productos</a>';
        echo '</div>';
        echo '</div>';
        echo '<a class="carrito" href="procesa_carro.php">Carrito</a>';
        echo '<a href="pechar_sesion.php">Cerrar Sesión</a>';
        echo '</div>';
    } else {
        // Se non, mostramos a opción de iniciar sesión
        echo '<a href="login.html">Iniciar Sesión</a>';
    }
    ?>
    <div class="centrado">
        <h3>O teu carro</h3>
        <?php
        // Verificar se hai productos no carrito
        if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
            echo "<h2>Carrito de Compras</h2>";
            echo "<div id='listado'>";
            echo "<table border='1'>";
            echo "<tr><th>Producto</th><th>Nome</th><th>Cantidade</th><th>Prezo</th></tr>";

            // Recorrer los productos en el carrito y mostrarlos en una tabla
            foreach ($_SESSION['carrito'] as $codigo_producto => $cantidad) {
                // Consultar la información del producto en la base de datos
                $query_producto = "SELECT Nombre, Prezo, RutaProducto FROM producto WHERE CodProducto = '$codigo_producto'";
                $result_producto = $conn->query($query_producto);

                if ($result_producto->num_rows > 0) {
                    $row_producto = $result_producto->fetch_assoc();
                    $nombre_producto = $row_producto['Nombre'];
                    $precio_producto = $row_producto['Prezo'];
                    $ruta_imagen = $row_producto['RutaProducto'];

                    echo "<tr>";
                    echo "<td><img src='" . $ruta_imagen . "' alt='Imaxe do producto' width='100'></td>";
                    echo "<td>" . $nombre_producto . "</td>";
                    echo "<td>" . $cantidad . "</td>";
                    echo "<td>" . $precio_producto . "</td>";
                    echo "</tr>";
                    echo "<tr>";
                   
                } else {
                    echo "<tr><td colspan='4'>Producto non encontrado</td></tr>";
                } 
            }
            echo "</div>";
            echo "<div class='total'>";
            echo "<td colspan='3'><strong>Total:</strong>";
            echo "<td></"
            echo "</div>";
            echo "</table>";
        } else {
            echo "<p>Non tes nada non carro.</p>";
        }
        ?>
    </div>
</body>
</html>
