<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MecaXallas</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="topnav">
        <a href="index.php">Inicio</a>
        <a class="active" href="categorias.php">Categorías</a>
        <a href="ofertas.php">Ofertas</a>
        <?php
        session_start();
        // Verificar usuario inició sesión
        if (isset($_SESSION['correo'])) {
            // Sesión iniciada aparece "Área Personal" e cerrar sesión
            echo '<a href="area_personal.php">Área Personal</a>';
            echo '<a href="pechar_sesion.php">Cerrar Sesión</a>';
        } else {
            // Si no, mostramos iniciar sesión
            echo '<a href="login.html">Iniciar Sesión</a>';
        }
        ?>
    </div>
    <div class="centro1">
        <h1>Categorías</h1>

        <?php
        // Conectamos a la base de datos
        $servername = "127.0.0.1";
        $username = "root";
        $password = "";
        $dbname = "pedidos";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Error en la conexión a base de datos: " . $conn->connect_error);
        }

        // Hacemos la consulta
        $query = "SELECT * FROM categoria WHERE Activo = 1";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $nombreCategoria = $row['Nombre'];
                $descripcionCategoria = $row['Descripcion'];
                $rutaImagen = $row['RutaIMX'];

                // Mostramos las categorías
                echo '<div class="categoria">';
                echo '<h2>' . $nombreCategoria . '</h2>';
                echo '<p>' . $descripcionCategoria . '</p>';
                echo '<img src="' . $rutaImagen . '" alt="' . $nombreCategoria . '">';
                echo '<a href="seccion.php?categoria=' . $nombreCategoria . '">Acceder a categoría</a>';
                echo '</div>';
            }
        } else {
            echo "Sin categorías disponibles";
        }
        ?>

    </div>

    <div class="footer">
        <p>© MercaXallas 2024</p>
    </div>
</body>

</html>
