<?php
// Verifica se foi enviado o formulario para eliminar o usuario
if (isset($_POST['eliminar-usuario'])) {
    // Conexión a base de datos
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "pedidos";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar a conexión
    if ($conn->connect_error) {
        die("Error en la conexión a la base de datos: " . $conn->connect_error);
    }

    // Coller a id do usuario a eliminar
    $idUsuarioEliminar = $_POST['id-usuario'];

    // Consulta SQL pa eliminar usuario
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
