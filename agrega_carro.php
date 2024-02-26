<?php
session_start();

// Verifico se o formulario se envion
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar se xa hai carro na sesion, e senón iniciamolo
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = array();
    }
    
    // Detalles do formulario
    $codigo_producto = $_POST['codigo_producto'];
    $cantidad = $_POST['cantidad'];

    // Verificar se xa ta no carro/ añadir se xa estaba
    if (array_key_exists($codigo_producto, $_SESSION['carrito'])) {
        $_SESSION['carrito'][$codigo_producto] += $cantidad;
    } else {
        // Añadir o carro o producto
        $_SESSION['carrito'][$codigo_producto] = $cantidad;
    }

    // Regreso
    header("Location: productos.php");
    exit();
}
?>
