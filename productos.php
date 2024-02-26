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
    <link rel="stylesheet" href="css/productos.css">
</head>

<body>
    <div class="topnav">
        <a href="index.php">Inicio</a>
        <a class="active" href="categorias.php">Categorías</a>
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
        
    </div>

    <div class="centro1">
        <h1>Productos</h1>
        <div class="productos">
<?php
// Verificar se pasou p parámetro da categoría na URL
if(isset($_GET['categoria'])) {
    // Obter o nome da categoría da URL
    $categoria = $_GET['categoria'];

    // Conectarse a base de datos
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "pedidos";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Error en la conexión a la base de datos: " . $conn->connect_error);
    }

    // Consulta de productos
    $query = "SELECT * FROM producto WHERE CodCategoria = (
                SELECT CodCategoria FROM categoria WHERE Nombre = '$categoria'
            ) AND Activo = 1";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Mostrar os productos
        while ($row = $result->fetch_assoc()) {
            $nombreProducto = $row['Nombre'];
            $descripcionProducto = $row['Descripcion'];
            $pesoProducto = $row['Peso'];
            $stockProducto = $row['Stock'];
            $precioProducto = $row['Prezo'];
            $rutaImagen = $row['RutaProducto'];
            // Mostrar os datos
            echo '<div class="categoria">';
            echo '<div class="tarjeta">';
            echo '<img src="' . $rutaImagen . '" alt="' . $nombreProducto . '">';
            echo "<p><strong>$nombreProducto</strong></p>";
            echo "<p><strong>$descripcionProducto</strong></p>";
            echo "<p><strong>Peso ud. $pesoProducto kg</strong></p>";
            echo "<p><strong>Stock:</strong> $stockProducto</p>";
            echo "<p><strong>Precio:</strong> $precioProducto €/Kilo-Unidade</p>";
            echo '<form action="agrega_carro.php" method="post">';
            echo '<input type="hidden" name="codigo_producto" value="' . $row['CodProducto'] . '">';
            echo '<input type="number" name="cantidad" value="1" min="1" max="' . $row['Stock'] . '">';
            echo '<input type="submit" value="Agregar al carrito">';
            echo '</form>';
            echo '</div>'; 
            echo '</div>';
            
        }
    } else {
        echo "Contra!! Semella que aínda non temos nada que ofrecer por aquí.";
    }

    // Pechamos a conexion
    $conn->close();
} else {
    echo "Categoría non especificada.";
}
?>
</div>
</div>
</body>

</html>