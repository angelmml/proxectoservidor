<?php
// Verifica si se ha enviado el formulario para eliminar el usuario
if (isset($_POST['eliminar-usuario'])) {
    // Conexión a la base de datos
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "pedidos";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica la conexión
    if ($conn->connect_error) {
        die("Error en la conexión a la base de datos: " . $conn->connect_error);
    }

    // Obtiene el ID del usuario a eliminar
    $idUsuarioEliminar = $_POST['id-usuario'];

    // Consulta SQL para eliminar el usuario
    $sql = "DELETE FROM usuario WHERE CodUsuario = $idUsuarioEliminar";

    // Ejecuta la consulta
    if ($conn->query($sql) === TRUE) {
        echo "Usuario eliminado exitosamente";
    } else {
        echo "Error al eliminar el usuario: " . $conn->error;
    }

    // Cierra la conexión
    $conn->close();
}
?>
