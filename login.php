<?php
session_start();

if (isset($_POST["correo"]) && isset($_POST["contrasinal"])) {
    $usuario = $_POST["correo"];
    $password = $_POST["contrasinal"];

    $mysqli = new mysqli("127.0.0.1", "root", "", "pedidos");

    if ($mysqli->connect_error) {
        die("La conexión a la base de datos ha fallado: " . $mysqli->connect_error);
    }

    $sql = "SELECT CodUsuario, Correo, Contrasinal, CodigoRol FROM usuario WHERE Correo = '$usuario'";
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if ($password == $row["Contrasinal"]) {
            $_SESSION["CodUsuario"] = $row["CodUsuario"];
            $_SESSION["Correo"] = $row["Correo"];
            $_SESSION["CodigoRol"] = $row["CodigoRol"];

            header("Location: index.html");
            exit();
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "Usuario no encontrado.";
    }

    $mysqli->close();
}
?>
