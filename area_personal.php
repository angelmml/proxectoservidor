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
                    echo "<p>Insertar usuarios</p>";
                    echo "<form action='.php' method='post'>";
                    echo "<label for='correo'>Correo: </label>";
                    echo "<input type='text' placeholder='Correo' name='correo' id='correo'><br>";
                    echo "<label for= 'password'>Contrasinal :</label>";
                    echo "<input type='password' placeholder='Contrasinal' name='contrasinal' id='contrasinal'><br>";
                    echo "<label for='pais'>País: </label>";
                    echo "<input type='text' placeholder='País' name='pais' id='pais'><br>";
                    echo "<label for='cp'>CP:</label>";
                    echo "<input type='text' placeholder='CP' name='cp' id='cp'><br>";
                    echo "<label for='cidade'>Cidade: </label>";
                    echo "<input type='text' placeholder='Cidade' name='cidade' id='cidade'><br>";
                    echo "<label for='enderezo'>Enderezo:</label>";
                    echo "<input type='text' placeholder='Enderezo' name='enderezo' id='enderezo'><br>";
                    echo "<label for='rol'>Rol do usuario:</label>";
                    echo "<select name='rol id='rol'>";
                    echo "<option value='administrador'>Administrador</option>";
                    echo "<option value='usuario'>Usuario</usuario>";
                    echo "</select>";
                    echo "<br><input type='checkbox' id='activo name='activo' value='1'>";
                    echo "<label for='activo'>Activo </label>";



                    echo "<h3>Listado de usuarios</h3>";


                    
                    // Táboa con opción de configurar/xestionar usuarios existentes
                }else{
                    echo " Perfil de Usuario";
                    echo "<h3>Historial de pedidos</h3>";
                }

        

                            
            }
        }
    ?>


</body>
</html>