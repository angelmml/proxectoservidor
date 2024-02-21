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
    <link rel="stylesheet" href="css/area_personal.css">
</head>
<body>
    <div class="topnav">
        <a href="index.php">Inicio</a>
        <a href="categorias.php">Categorías</a>
        <a href="ofertas.php">Ofertas</a>
        <?php
        // Verificar usuario iniciou sesión
        if (isset($_SESSION['correo'])) {
        // Sesion iniciada aparece "Xestión" e pechar sesion
        echo '<a class="active" href="area_personal.php">Xestión</a>';
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
                    echo "<h3>Xestor de categorías</h3>";
                    // Procesar el formulario de inserción
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $catNome = $_POST["nombre"];
                    $catDescripcion = $_POST["descripcion"];
                    $catActivo = isset($_POST["activo"]) ? 1 : 0;
                    $catRutaIMX = $_POST["rutaIMX"];
                    $catRutaIcono = $_POST["rutaIcono"];
                   

                // Consulta para insertar un novo usuario
                $insertQuery = "INSERT INTO categoria (Nombre, Descripcion, Activo, RutaIMX, RutaIcono)
                                VALUES ('$catNome', '$catDescripcion', '$catActivo', '$catRutaIMX', '$catRutaIcono')";

//Echo para poder ver a consulta (resultado)                    
echo $insertQuery;
                if ($conn->query($insertQuery) === TRUE) {
                    echo "<p>novo usuario insertado correctamente.</p>";
                } else {
                    echo "<p>Error al insertar la nueva categoria: " . $conn->error . "</p>";
                }
            }
            ?>
                <!--Formulario no que se engaden as categorias-->
                <div class='form_usuario'>
                <p><strong>Inserción de categorias</strong></p>
                <form method='post'>
                <label for='nombre'>Nome : </label>
                <input type='text' placeholder='Nome da categoria' name='nombre' id='nombre'>
                <label for= 'descripcion'>Descripción :</label>
                <input type='text' placeholder='Descripción' name='descripcion' id='descripcion'>
                <label for='rutaIMX'>Ruta da imaxe : </label>
                <input type='text' placeholder='Ruta da imaxe' name='rutaIMX' id='rutaIMX'>
                <label for='rutaIcono'>Ruta da icona : </label>
                <input type='text' placeholder='Ruta da icona' name='rutaIcono' id='rutaIcono'>
                <label for='activo'>Activo:</label>
                <input type='checkbox' id='activo' name='activo' value='1'>
                <input type='submit' value='Insertar Categoría'>
                <input type='submit' value='Actualizar'>
                <input type='reset' value='Limpiar'>
                </form>
                </div>
                <!--Listado categorias-->   
                <h3>Listado de categorías</h3>
                <div id="listado">
                    <table border='1'>
                   <tr><th>CodCategoria</th><th>Nombre</th><th>Descripcion</th><th>Activo</th><th>RutaIMX</th><th>RutaIcono</th></tr>
        
                  <?php  // Consulta para obter todos os categorias
                    $queryCategoria = "SELECT * FROM categoria";
                    $resultCategoria = $conn->query($queryCategoria);
        
                    if ($resultCategoria->num_rows > 0) {
                        while ($rowCategoria = $resultCategoria->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($rowCategoria['CodCategoria']) . "</td>";
                            echo "<td>" . htmlspecialchars($rowCategoria['Nombre']) . "</td>";
                            echo "<td>" . htmlspecialchars($rowCategoria['Descripcion']) . "</td>";
                            echo "<td>" . htmlspecialchars($rowCategoria['Activo']) . "</td>";
                            echo "<td>" . htmlspecialchars($rowCategoria['RutaIMX']) . "</td>";
                            echo "<td>" . htmlspecialchars($rowCategoria['RutaIcono']) . "</td>";
                           /* echo "<form method='post'>";
                            echo "<input type='hidden' name='id-categoria' value='" . $rowCategoria['CodUsuario'] . "'>";
                            echo "<input type='submit' name='editar-categoria' value='Editar'>";
                            echo "</form>";
                            echo "</td>";
                            echo "<td>";
                            echo "<form action='elimina_categoria.php' method='post'>";
                            echo "<input type='hidden' name='id_usuario' value='" . $rowCategoria['ID'] . "'>";
                            echo "<input type='submit' value='Eliminar'>";
                            echo "</form>";*/
                            echo "</td>";
                            echo "</tr>";
                            
                        }
                    } else {
                        echo "<tr><td colspan='8'>Non hai categorias rexistradas</td></tr>";
                    }
                    echo "</table>";
                echo "</div>";
                    // Táboa con opción de configurar/xestionar categorias existentes
                }else{
                    echo "Acceso denegado";
                }             
            }
    ?>

</body>
</html>