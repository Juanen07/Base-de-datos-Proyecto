<?php
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
$sql = "SELECT * FROM libros";

// Preparar, ejecutar la consulta y obtener los resultados
try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $libros = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error al ejecutar la consulta: " . $e->getMessage());
}

// Mostrar los resultados en HTML
echo "<div align='center' style='font-weight: bold; font-size: 40px; margin-top: 30; color: white;'>Listado de Libros</div><br>";
echo "<HR noshade align='center'><br>";
echo "<div class='link divALaIzquierda'><a href=\"login.php\" style='color: white;'>Regresar</a></div><br><br>";

echo "<div class='tabla'>
<div class='encabezado'>
<div class='celdas'>ISBN</div>
<div class='celdas'>ID Ejemplar</div>
<div class='celdas'>Título</div>
<div class='celdas'>Autor</div>
<div class='celdas'>Editorial</div>
<div class='celdas'>Año Publicación</div>
<div class='celdas'>Ejemplar</div>
<div class='celdas'>Estado</div>
</div>";
foreach ($libros as $libro) {
$isbn = $libro["isbn"];
$id_ejemplar = $libro["id_ejemplar"];
$titulo = $libro["titulo"];
$autor = $libro["autor"];
$editorial = $libro["editorial"];
$ano_public = $libro["ano_public"];
$ejemplar = $libro["ejemplar"];
$estado = $libro["status"] ? "Disponible" : "Prestado";

echo "<div class='filas2' id='tr$isbn'>
    <div class='celdas'>$isbn</div>
    <div class='celdas'>$id_ejemplar</div>
    <div class='celdas'>$titulo</div>
    <div class='celdas'>$autor</div>
    <div class='celdas'>$editorial</div>
    <div class='celdas'>$ano_public</div>
    <div class='celdas'>$ejemplar</div>
    <div class='celdas'>$estado</div>
   
</div>";
}
echo "</div>
    <div id='mensaje'></div>";
?>
<title>Listado de Libros</title>

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
