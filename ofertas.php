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
        <a class="active" href="ofertas.php">Ofertas</a>
        <?php
        session_start();
        // Verificar usuario iniciou sesión
        if (isset($_SESSION['correo'])) {
        // Sesion iniciada aparece "Xestion" e pechar sesion
        echo '<a href="area_personal.php">Xestión</a>';
        echo '<a href="pechar_sesion.php">Cerrar Sesión</a>';
        } else {
        // Se non, amosamos iniciar sesion
        echo '<a href="login.html">Iniciar Sesión</a>';
    }
    ?>
    </div>
    <div class="centro1">
        <h1>Descrubre os nosos productos</h1>
    </div>

    <h2 style="text-align:center">Ofertas do día</h2>
        <div class="cards-container">
            <div class="card">
                <img src="imaxes/repolo.jpg" alt="Repolo" style="width:100%">
                <h1>Repolo Galego</h1>
                <p class="price">$4.99</p>
                <p>Repolos. Super slim and comfy lorem ipsum lorem jeansum. Lorem jeamsun denim lorem jeansum.</p>
                <p><button>Engadir ao carriño</button></p>
            </div>
            <div class="card">
                <img src="imaxes/leitepremium.jpg" alt="LeitePremium" style="width:100%">
                <h1>Leite Premium </h1>
                <p class="price">€2.99</p>
                <p>Leite de vaca lorem ipsum lorem jeansum. Lorem jeamsun denim lorem jeansum.</p>
                <p><button>Engadir ao carriño</button></p>
            </div>
            <div class="card">
                <img src="imaxes/chourizos.png" alt="Chourizos" style="width:100%">
                <h1>Chourizos Xallas</h1>
                <p class="price">€14.99</p>
                <p>Chourizos xalleiros lorem ipsum lorem jeansum. Lorem jeamsun denim lorem jeansum.</p>
                <p><button>Engadir ao carriño</button></p>
            </div>
        </div>
    <div class="footer">
        <p>© MercaXallas 2024</p>
    </div>
</body>

</html>