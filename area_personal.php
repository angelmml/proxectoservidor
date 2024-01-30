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
        <h3>Benvido de novo <?php echo $correo ?></h3>
    </div>

    <?php
        //Conectamos a base de datos
        $servername = "127.0.0.1";
        $username = "root";
        $password = "";
        $dbname = "pedidos";

        $conn = new mysqli($servername, $username, $password, $dbname);



        if ($conn->connect_error){
            die("Error na conexión a base de datos:". $conn->connect_error);
        }
        //Consulta

        $query = "SELECT Correo, CodigoRol from usuario where CodigoRol = 1";
        $result = $conn -> query($query);

        if ($result->num_rows> 0){
            while($row = $result->fetch_assoc()){
                $nom_correo = $row['Correo'];
                $cod_rol = $row['CodigoRol'];

                if ($correo === $nom_correo){
                    echo "<h2>Portal de Administración</h2>";

                    echo "<h3>Xestor de usuarios</h3>";

                    // Formulario no que se engaden os usuarios

                    echo "<h3>Listado de usuarios</h3>";

                    // Táboa con opción de configurar/xestionar usuarios existentes
                }else{
                    echo " Perfil de Usuario";
                }

        

                            
            }
        }
    ?>


</body>
</html>