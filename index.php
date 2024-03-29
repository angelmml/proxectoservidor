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
        echo '<a href="pechar_sesion.php">Cerrar Sesión</a>';
        echo '</div>';
       
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
    <h5>ACCESO RÁPIDO</h5>
    
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
        $codCategoria = $row['CodCategoria']; // Añadir el código de la categoría

        // Mostrar las categorías con enlaces
        echo '<div class="categoria-container">';
        echo '<div class="categoria">';
        echo '<a href="productos.php?categoria=' . urlencode($nombreCategoria) . '">';
        echo '<img src="' . $rutaImagen . '" alt="' . $nombreCategoria . '">';
        echo '<span>' . $nombreCategoria . '</span>';
        echo '</a>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo "Sin categorías disponibles";
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
<div class="footer">
    <p>© MercaXallas 2024</p>
</div>    	
</body>
</html>
