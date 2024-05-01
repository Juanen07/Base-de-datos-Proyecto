<?php
include 'funciones/comprobarSesion.php';
$host = 'localhost';
$dbname = 'biblioteca';
$user = 'postgres';
$password = '12345678';

// Conexión a la base de datos con PDO
try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}


$sql = "SELECT id, id_alumno, id_profesor, isbn, id_ejemplar, fecha_prestamo, fecha_ideal, fecha_devolucion, adeudo FROM prestamos";


// Preparar, ejecutar la consulta y obtener los resultados
try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $prestamos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error al ejecutar la consulta: " . $e->getMessage());
}

// Mostrar los resultados en HTML
echo "<div align='center' style='font-weight: bold; font-size: 40px; margin-top: 30; color: white;'>Listado de Préstamos</div><br>";
echo "<HR noshade align='center'><br>";
echo "<div class='link divALaIzquierda'><a href=\"ingreso.php\" style='color: white;'>Regresar</a></div><br><br>";

echo "<div class='tabla'>
<div class='encabezado'>
<div class='celdas'>ID Préstamo</div>
<div class='celdas'>ID Alumno</div>
<div class='celdas'>ID Profesor</div>
<div class='celdas'>ISBN</div>
<div class='celdas'>ID Ejemplar</div>
<div class='celdas'>Fecha Préstamo</div>
<div class='celdas'>Fecha Ideal</div>
<div class='celdas'>Fecha Devolución</div>
<div class='celdas'>Adeudo</div> <!-- Nueva columna para el adeudo -->
</div>";
foreach ($prestamos as $prestamo) {
$id_prestamo = $prestamo["id"];
$id_alumno = $prestamo["id_alumno"];
$id_profesor = $prestamo["id_profesor"];
$isbn = $prestamo["isbn"];
$id_ejemplar = $prestamo["id_ejemplar"];
$fecha_prestamo = $prestamo["fecha_prestamo"];
$fecha_ideal = $prestamo["fecha_ideal"];
$fecha_devolucion = $prestamo["fecha_devolucion"];
$adeudo = $prestamo["adeudo"]; // Nueva variable para el adeudo

echo "<div class='filas2' id='tr$id_prestamo'>
    <div class='celdas'>$id_prestamo</div>
    <div class='celdas'>$id_alumno</div>
    <div class='celdas'>$id_profesor</div>
    <div class='celdas'>$isbn</div>
    <div class='celdas'>$id_ejemplar</div>
    <div class='celdas'>$fecha_prestamo</div>
    <div class='celdas'>$fecha_ideal</div>
    <div class='celdas'>$fecha_devolucion</div>
    <div class='celdas'>$adeudo</div> <!-- Mostrar adeudo -->
</div>";
}
echo "</div>";
?>
<title>Listado de Préstamos</title>
<script src="JS/jquery-3.3.1.min.js"></script>
<style>
    .divALaIzquierda {
        margin: 0px 0px 0px 83%;
    }

    .tabla {
        display: table;
        width: 1200px;
        border: 2px solid black;
        margin: auto;
    }

    .encabezado {
        display: table-row;
        text-align: center;
        line-height: 50px;
        font-weight: bold;
        height: 50px;
        background-color: goldenrod;
    }

    .filas2 {
        display: table-row;
        border: 2px solid black;
        background-color: yellow;
    }

    .celdas {
        display: table-cell;
        border: 2px solid black;
        text-align: center;
        vertical-align: middle;
        width: 15%;
        width: 100px;
    }

    body {
        background-image: url("imagenes/imagen3.jpg");
        background-size: cover;
        background-repeat: no-repeat;
        margin: 0;
        height: 100vh;
    }

    a {
        color: black;
        font-weight: bold;
    }

    a:hover {
        color: blue;
    }

    a:active {
        color: red;
    }
</style>
