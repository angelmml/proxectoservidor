<?php
session_start(); 

if(isset($_POST["correo"]) && isset($_POST["password"]))
{

  
    $usuario=substr($_POST["correo"],0,30);
    $password=substr($_POST["password"],0,30);
    if(preg_match("/(*UTF8)^[\p{L}\p{N}]{1,30}$/",$usuario)) {
        if(strlen($password)>=4) {
            $mysqli = new mysqli("127.0.0.1", "root", "", "pedidos");
            if ($mysqli) {
                $sql = "SELECT Correo,Contrasinal FROM usuario ".
                        "WHERE Correo='$usuario'";  
                $res=$mysqli->query($sql);
                if ($res == false)
                    $error = ERROR_CONEXION;
                else{
                    $fila=$res->fetch_assoc();
                    if($fila){
                   
                        if(password_verify($password,$fila["password"])){ 
                          
                            $_SESSION["Correo"]=$fila["Correo"]; 
                            $res->close();
                        }
                        else $error=ERROR_USUARIO_PASSWORD;
                    }
                    else $error=ERROR_USUARIO_NO_EXISTE;
                }

            } else $error = ERROR_CONEXION;
        }
        else $error=ERROR_PASSWORD_CORTA;
    }
    else $error=ERROR_USUARIO_INVALIDO;
}
else{
    header("Location:index.html");
}

    header("Location:usuario.html");
?>

