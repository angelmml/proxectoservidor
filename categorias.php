
<!doctype html>
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
        // Verificar usuario iniciou sesión
        if (isset($_SESSION['correo'])) {
        // Sesion iniciada aparece "Área Personal" e pechar sesion
        echo '<a href="area_personal.php">Área Personal</a>';
        echo '<a href="pechar_sesion.php">Cerrar Sesión</a>';
        } else {
        // Se non, amosamos iniciar sesion
        echo '<a href="login.html">Iniciar Sesión</a>';
    }
    ?>
    </div>
    <div class="centro1">
        <h1>Categorías</h1>

        <?php
        //Conectamos a base de datos
        $servername = "127.0.0.1";
        $username = "root";
        $password = "";
        $dbname = "pedidos";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
        die("Error  na conexión a base de datos: " . $conn->connect_error);
        }

        //Gacemos a consulta
        $query = "SELECT * FROM categoria WHERE Activo = 1";
        $result = $conn -> query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $nombreCategoria = $row['Nombre'];
                $descripcionCategoria = $row['Descripcion'];

                // Mostramos as caterogias
                echo '<div class="categoria">';
                echo '<h2>' . $nombreCategoria . '</h2>';
                echo '<p>' . $descripcionCategoria . '</p>';
                echo '</div>';
                }
            } else {
                echo "Sen categorías dispoñibles";
                    }

                ?>

    </div>

  

    </div>
    <div class="footer">
        <p>© MercaXallas 2024</p>
    </div>
</body>

</html>