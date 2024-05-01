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

// Consulta SQL
$sql = "SELECT * FROM alumno";

// Preparar, ejecutar la consulta y obtener los resultados
try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $alumnos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error al ejecutar la consulta: " . $e->getMessage());
}

// Mostrar los resultados en HTML
echo "<div align='center' style='font-weight: bold; font-size: 40px; margin-top: 30; color: white;'>Listado de Alumnos</div><br>";
echo "<HR noshade align='center'><br>";
echo "<div class='link divALaIzquierda'><a href=\"ingreso.php\" style='color: white;'>Regresar</a></div><br><br>";
echo "<div class='link divALaDerecha'><a href=\"alumnos_alta.php\" style='color: white;'>Crear nuevo registro</a></div><br><br>";



echo "<div class='tabla'>
    <div class='encabezado'>
        <div class='celdas'>Código</div>
        <div class='celdas'>Nombre</div>
        <div class='celdas'>Carrera</div>
        <div class='celdas'>Correo</div>
        <div class='celdas'>Adeudo</div>
    </div>";
        foreach ($alumnos as $alumno) {
            $codigo = $alumno["codigo"];
            $nombre = $alumno["nombre"];
            $carrera = $alumno["carrera"];
            $correo = $alumno["correo"];
            $adeudo = $alumno["adeudo"];
            
            echo "<div class='filas2' id='tr$codigo'>
                <div class='celdas'>$codigo</div>
                <div class='celdas'>$nombre</div>
                <div class='celdas'>$carrera</div>
                <div class='celdas'>$correo</div>
                <div class='celdas'>$adeudo</div>
            </div>";
        }
echo "</div>
    <div id='mensaje'></div>";
?>
<title>Listado de Alumnos</title>
<script src="JS/jquery-3.3.1.min.js"></script>

<style>
    .divALaDerecha {
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

    #mensaje {
        color: #F00;
        font-size: 18px;
        font-weight: bold;
        width: 400px;
        height: 30px;
        line-height: 30px;
        text-align: center;
        margin:15px auto;
      }
</style>
