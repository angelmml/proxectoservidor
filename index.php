
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
        <a class="active" href="#inicio">Inicio</a>
        <a href="categorias.php">Categorías</a>
        <a href="ofertas.html">Ofertas</a>
        <?php
        session_start();
        // Verificar si el usuario ha iniciado sesión
        if (isset($_SESSION['correo'])) {
        // Si ha iniciado sesión, mostrar enlace a "Área Personal"
        echo '<a href="area_personal.php">Área Personal</a>';
        echo '<a href="pechar_sesion.php">Cerrar Sesión</a>';
        } else {
        // Si no ha iniciado sesión, mostrar enlace a "Iniciar Sesión"
        echo '<a href="login.html">Iniciar Sesión</a>';
    }
    ?>

        <a href="login.html">Iniciar Sesión</a>
    </div>
    <div class="centro1">
	<h1>MercaXallas</h1>
    </div>

    
<div class="footer">
    <p>©MercaXallas 2024</p>
</div>    	
</body>
</html>
