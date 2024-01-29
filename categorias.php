
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
    </div>

    <div class="mostracategorias">

        <h3 id="carnes">Carnes</h3>        
        <h3 id="peixes">Peixes</h3>
        <h3 id="froitas_verduras">Froitas e Verduras</h3>
        <h3 id="conxelados">Conxelados</h3>
        <h3 id="pastas">Pastas e Arroces</h3>
        <h3 id="panaderia">Panaderia & Bollería</h3>
        <h3 id="snacks">Snaks e Chucherías</h3>
        <h3 id="fogar">Fogar</h3>
        <h3 id="hixiene">Hixiene</h3>
        <h3 id="mascotas"></h3>

    </div>
    <div class="footer">
        <p>©MercaXallas 2024</p>
    </div>
</body>

</html>