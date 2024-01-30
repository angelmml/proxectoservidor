<?php
session_start();


if (!isset($_SESSION['correo'])) {
    header("Location: login.html");
    exit();
}

$correo = $_SESSION['correo'];

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

        $query = "SELECT Correo, CodigoRol from usuario where Correo = '$correo'";
        $result = $conn -> query($query);

        if ($result->num_rows> 0){
                $row = $result->fetch_assoc();
                $nom_correo = $row['Correo'];
                $cod_rol = $row['CodigoRol'];
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
                if ($cod_rol == 1){
                    echo "<h2>Portal de Administración</h2>";
                    echo "<h3>Xestor de usuarios</h3>";
                    // Procesar el formulario de inserción
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $novoCorreo = $_POST["correo"];
                    $novoContrasinal = $_POST["contrasinal"];
                    $novoPais = $_POST["pais"];
                    $novoCP = $_POST["cp"];
                    $nuevaCiudad = $_POST["cidade"];
                    $novoEnderezo = $_POST["enderezo"];
                    $novoRol = $_POST["rol"];
                    $activo = isset($_POST["activo"]) ? 1 : 0;

                // Consulta para insertar un novo usuario
                $insertQuery = "INSERT INTO usuario (Correo, Contrasinal, Pais, CP, Ciudad, Enderezo, CodigoRol, Activo)
                                VALUES ('$novoCorreo', '$novoContrasinal', '$novoPais', $novoCP, '$nuevaCiudad', '$novoEnderezo', $novoRol, $activo)";

                if ($conn->query($insertQuery) === TRUE) {
                    echo "<p>novo usuario insertado correctamente.</p>";
                } else {
                    echo "<p>Error al insertar el novo usuario: " . $conn->error . "</p>";
                }
            }


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
                    echo "<label for='activo'>Activo</label>";

                    //Listado usuarios
                    echo "<h3>Listado de usuarios</h3>";

                    echo "<table border='1'>";
                    echo "<tr><th>ID</th><th>Correo</th><th>Contraseña</th><th>País</th><th>CP</th><th>Ciudad</th><th>Dirección</th><th>Rol</th></tr>";
        
                    // Consulta para obtener todos los usuarios
                    $queryUsuarios = "SELECT * FROM usuario";
                    $resultUsuarios = $conn->query($queryUsuarios);
        
                    if ($resultUsuarios->num_rows > 0) {
                        while ($rowUsuario = $resultUsuarios->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($rowUsuario['CodUsuario']) . "</td>";
                            echo "<td>" . htmlspecialchars($rowUsuario['Correo']) . "</td>";
                            echo "<td>" . htmlspecialchars($rowUsuario['Contrasinal']) . "</td>";
                            echo "<td>" . htmlspecialchars($rowUsuario['Pais']) . "</td>";
                            echo "<td>" . htmlspecialchars($rowUsuario['CP']) . "</td>";
                            echo "<td>" . htmlspecialchars($rowUsuario['Ciudad']) . "</td>";
                            echo "<td>" . htmlspecialchars($rowUsuario['Enderezo']) . "</td>";
                            echo "<td>" . htmlspecialchars($rowUsuario['CodigoRol']) . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8'>No hay usuarios registrados</td></tr>";
                    }
        
                    echo "</table>";
                    
                    // Táboa con opción de configurar/xestionar usuarios existentes
                }else{
                    echo " Perfil de Usuario";
                    echo "<h3>Historial de pedidos</h3>";
                }             
            }
    ?>
</body>
</html>