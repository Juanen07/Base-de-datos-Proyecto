<?php
session_start();

// Verificar si el usuario no está autenticado como administrador
if (!isset($_SESSION['nombre_usuario'])) {
    // Redirigir al usuario a la página de inicio de sesión
    header("Location:login.php");
    exit();
}
?>
