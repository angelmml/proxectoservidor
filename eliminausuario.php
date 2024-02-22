<?php
session_start();

if (!isset($_SESSION['correo'])) {
    header("Location: login.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id_usuario"])) {
    $idUsuario = $_POST["id_usuario"];

    //Conectamos a base de datos
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "pedidos";
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error){
        die("Error na conexión a base de datos:". $conn->connect_error);
    }

    // Consulta para eliminar o usuario
    $deleteQuery = "DELETE FROM usuario WHERE CodUsuario = '$idUsuario'";

    if ($conn->query($deleteQuery) === TRUE) {
        echo "<p>Usuario eliminado correctamente.</p>";
    } else {
        echo "<p>Error ao eliminar o usuario: " . $conn->error . "</p>";
    }

    $conn->close();

    header("Location: area_personal.php");
}
?>
