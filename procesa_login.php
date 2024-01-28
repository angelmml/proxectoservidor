<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "pedidos";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error en la conexión a la base de datos: " . $conn->connect_error);
}

// Recollemos os datos do usuario
$correo = $_POST['correo'];
$password = $_POST['password'];

// Consultar na base de datos
$query = "SELECT * FROM usuario WHERE Correo = '$correo' AND Contrasinal = '$password'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    // Inicio de sesión exitoso
    session_start();
    $_SESSION['correo'] = $correo;
    // Puedes redirigir al usuario a otra página después del inicio de sesión
    header("Location: index.php");
} else {
    // Inicio de sesión fallido
    echo "Credenciales incorrectas. Intenta de nuevo.";
}

$conn->close();
?>
