
<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>MercaXallas</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="topnav">
        <a class="active" href="#inicio">Inicio</a>
        <a href="categorias.php">Categorías</a>
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
	<h1>MercaXallas</h1>
    </div>

    <div class="columna1">
    <h5>Acceso rápido</h5>
    
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
                $rutaImagen = $row['RutaIcono'];
                $nombreCategoria = $row['Nombre'];
                

                // Mostramos as categorías
                echo '<div class="categoria-container">';
                echo '<div class="categoria">';
                echo '<img src="' . $rutaImagen . '" alt="' . $nombreCategoria . '">';
                echo '<span>' . $nombreCategoria . '</span>';
                echo '</div>';
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
