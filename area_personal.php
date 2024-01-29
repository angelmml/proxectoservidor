<?php
session_start();

if (!isset($_SESSION['correo'])) {
    header("Location: login.html");
    exit();
}

$correo = $_SESSION['correo'];
?>

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
        <a href="categorias.php">Categorías</a>
        <a href="ofertas.php">Ofertas</a>
        <?php
        // Verificar usuario iniciou sesión
        if (isset($_SESSION['correo'])) {
        // Sesion iniciada aparece "Área Personal" e pechar sesion
        echo '<a class="active" href="area_personal.php">Área Personal</a>';
        echo '<a href="pechar_sesion.php">Cerrar Sesión</a>';
        } else {
        // Se non, amosamos iniciar sesion
        echo '<a href="login.html">Iniciar Sesión</a>';
    }
    ?>
    </div>

    <div>
        <h3>Benvido <?php echo $correo ?></h3>
    </div>

    <h2>Os meus pedidos</h2>
    <?php
  
    ?>


</body>
</html>