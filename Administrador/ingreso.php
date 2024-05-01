<?php
include 'funciones/comprobarSesion.php';
echo "<div align='center' style='font-weight: bold; font-size: 40px; margin-top: 10; color: white;'>BIBLIOTECA VIRTUAL</div><br>";
$usuario=$_SESSION['nombre_usuario'];
echo "<h1 id='titulo' style='text-align: center; color: white;'>Bienvenido $usuario</h1>";
?>

<style>
body {
    background-image: url("imagenes/imagen3.jpg");
    background-size: cover;
    background-repeat: no-repeat;
    margin: 0;
    height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: flex-start; /* Alinear el contenido al principio */
    align-items: center;
    font-family: Arial, sans-serif;
}

.menu-container {
    display: flex;
    flex-direction: column; /* Cambiar la orientación a vertical */
    align-items: flex-start; /* Alinear los elementos a la izquierda */
    background-color: #333;
    color: white;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.2);
}

.menu-item {
    color: white;
    cursor: pointer;
    margin-bottom: 20px; /* Espacio entre elementos del menú */
}

.submenu {
    display: none;
    background-color: #fff;
    color: #333;
    padding: 10px;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.2);
    margin-left: 10px; /* Espacio a la izquierda para el submenu */
}

.menu-item.active .submenu {
    display: block;
}

.submenu-item {
    padding: 5px 0;
}

.submenu-item:hover {
    background-color: #f1f1f1; /* Cambio de color al pasar el ratón */
}

#contenido {
    margin-top: 20px;
    color: white;
}

/* Estilos para el botón de cerrar sesión */
.cerrar-sesion {
    position: absolute;
    top: 10px;
    right: 10px;
    background-color: #333;
    color: white;
    padding: 5px 10px;
    border-radius: 5px;
    cursor: pointer;
}
</style>

<div class="cerrar-sesion">
    <a href="funciones/cerrarSesion.php" style="color: white; text-decoration: none;">Cerrar Sesión</a>
</div>

<div class="menu-container">
    <div class="menu-item" onclick="toggleSubMenu(this)">
        Alumnos
        <div class="submenu">
            <div class="submenu-item"><a href="alumnos_alta.php">Altas</a></div>
            <div class="submenu-item"><a href="alumno_lista.php">Consultas</a></div>
        </div>
    </div>
    <div class="menu-item" onclick="toggleSubMenu(this)">
        Profesores
        <div class="submenu">
            <div class="submenu-item"><a href="profesor_alta.php">Altas</a></div>
            <div class="submenu-item"><a href="profesor_lista.php">Consultas</a></div>
        </div>
    </div>
    <div class="menu-item" onclick="toggleSubMenu(this)">
        Libros
        <div class="submenu">
            <div class="submenu-item"><a href="libros_alta.php">Altas</a></div>
            <div class="submenu-item"><a href="libros_lista.php">Consultas</a></div>
        </div>
    </div>
    <div class="menu-item" onclick="toggleSubMenu(this)">
        Prestamos
        <div class="submenu">
            <div class="submenu-item"><a href="solicitud_prestamo.php">Altas</a></div>
            <div class="submenu-item"><a href="prestamos_lista.php">Consultas</a></div>
        </div>
    </div>
    <div class="menu-item" onclick="toggleSubMenu(this)">
        Entregas
        <div class="submenu">
            <div class="submenu-item"><a href="formulario_devolucion.php">Altas</a></div>
        </div>
    </div>
</div>

<div id="contenido">
    <!-- Aquí puedes colocar el contenido principal de tu página -->
</div>

<script>
function toggleSubMenu(element) {
    var submenu = element.querySelector('.submenu');
    submenu.style.display = submenu.style.display === 'block' ? 'none' : 'block';
}
</script>
