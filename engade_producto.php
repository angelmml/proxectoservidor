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
    <link rel="stylesheet" href="css/engade_producto.css">
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
                    echo "<h3>Xestor de productos</h3>";
                    // Procesar el formulario de inserción
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $proNome = $_POST["nombre"];
                    $proDescripcion = $_POST["descripcion"];
                    $proPeso = $_POST["peso"];
                    $proStock = $_POST["stock"];
                    $proCodCategoria = $_POST["codCategoria"];
                    $proActivo = isset($_POST["activo"]) ? 1 : 0;
                    $proPrezo = $_POST["prezo"];
                    $proRutaProducto = $_POST["rutaProducto"];
                // Consulta para insertar un novo usuario
                $insertQuery = "INSERT INTO producto (Nombre, Descripcion, Peso, Stock, CodCategoria, Activo, Prezo, RutaProducto)
                VALUES ('$proNome', '$proDescripcion','$proPeso', '$proStock','$proCodCategoria' ,'$proActivo', '$proPrezo', '$proRutaProducto')";


//Echo para poder ver a consulta (resultado)                    
echo $insertQuery;
                if ($conn->query($insertQuery) === TRUE) {
                    echo "<p>Novo producto insertado correctamente.</p>";
                } else {
                    echo "<p>Error ao insertar o novo producto: " . $conn->error . "</p>";
                }
            }
            ?>
                <!--Formulario no que se engaden os productos-->
                <div class='form_usuario'>
                <p><strong>Inserción de productos</strong></p>
                <form method='post'>
                <label for='nombre'>Nome : </label>
                <input type='text' placeholder='Nome do producto' name='nombre' id='nombre'>
                <label for= 'descripcion'>Descripción :</label>
                <input type='text' placeholder='Descripción' name='descripcion' id='descripcion'>
                <label for= 'peso'>Peso :</label>
                <input type='number' placeholder='Peso do producto' name='peso' id='peso'step="0.01">
                <label for= 'stock'>Stock :</label>
                <input type='number' placeholder='Stock do producto' name='stock' id='stock'>
                <label for= 'codCategoria'>Cod categoria:</lablel>
                <input type='number' placeholder='Codigo da categoria' name='codCategoria' id='codCategoria'>                
                <label for='activo'>Activo:</label>
                <input type='checkbox' id='activo' name='activo' value='1'>
                <label for= 'prezo'>Prezo :</label>
                <input type='prezo' placeholder='Prezo do producto' name='prezo' id='prezo'>
                <label for='rutaProducto'>Ruta imaxe do producto : </label>
                <input type='text' placeholder='Ruta imaxe producto' name='rutaProducto' id='rutaProducto'>
                <input type='submit' value='Insertar Categoría'>
                <input type='submit' value='Actualizar'>
                <input type='reset' value='Limpiar'>
                </form>
                </div>
                <!--Listado productos-->   
                <h3>Listado de productos</h3>
                <div id="listado">
                    <table border='1'>
                   <tr><th>CodProducto</th><th>Nombre</th><th>Descripcion</th><th>Peso</th><th>Stock</th><th>Cod.Categoría</th><th>Activo</th><th>Prezo</th><th>RutaProducto</th></tr>
        
                  <?php  // Consulta para obter todos os categorias
                    $queryProducto = "SELECT * FROM productos";
                    $resultProducto = $conn->query($queryProducto);
        
                    if ($resultProducto->num_rows > 0) {
                        while ($rowProducto= $resultCategoria->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($rowProducto['CodCategoria']) . "</td>";
                            echo "<td>" . htmlspecialchars($rowProducto['Nombre']) . "</td>";
                            echo "<td>" . htmlspecialchars($rowProducto['Descripcion']) . "</td>";
                            echo "<td>" . htmlspecialchars($rowProducto['Activo']) . "</td>";
                            echo "<td>" . htmlspecialchars($rowProducto['RutaIMX']) . "</td>";
                            echo "<td>" . htmlspecialchars($rowProducto['RutaIcono']) . "</td>";
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