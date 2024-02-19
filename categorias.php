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
        session_start();
        // Verificar usuario iniciou sesión
        if (isset($_SESSION['correo'])) {
            // Sesión iniciada aparece "Área Personal" e cerrar sesión
            echo '<a href="area_personal.php">Área Personal</a>';
            echo '<a href="pechar_sesion.php">Cerrar Sesión</a>';
        } else {
            // Se non a ten, mostramos iniciar sesión
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
                die("Error en la conexión a base de datos: " . $conn->connect_error);
            }

            // Facemos a consulta
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
                    echo '<a href="productos.php?categoria=' . urlencode($nombreCategoria) . '">Acceder a categoría</a>';
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

   <!-- <div class="footer">
        <p>© MercaXallas 2024</p>
    </div>
        -->
</body>

</html>
