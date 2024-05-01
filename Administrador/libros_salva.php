<?php
include 'funciones/comprobarSesion.php';
$dsn = 'pgsql:host=localhost;dbname=biblioteca;port=5432';
$usuario = 'postgres';
$password = '12345678';

try {
    $con = new PDO($dsn, $usuario, $password);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Error al conectarse a la base de datos: ' . $e->getMessage();
    exit;
}

// Recibe variables
$isbn = $_REQUEST['isbn'];
$titulo = $_REQUEST['titulo'];
$autor = $_REQUEST['autor'];
$editorial = $_REQUEST['editorial'];
$ano_public = $_REQUEST['ano_public'];
$ejemplar = $_REQUEST['ejemplar'];

// Validar campos
if (empty($isbn) || empty($titulo) || empty($autor) || empty($editorial) || empty($ano_public) || empty($ejemplar)) {
    echo "Faltan campos por llenar";
    exit;
}

// Preparar la consulta SQL
$sql = "INSERT INTO libros (isbn, titulo, autor, editorial, ano_public, ejemplar) VALUES (:isbn, :titulo, :autor, :editorial, :ano_public, :ejemplar)";
$stmt = $con->prepare($sql);

// Ejecutar la consulta
$res = $stmt->execute([
    'isbn' => $isbn,
    'titulo' => $titulo,
    'autor' => $autor,
    'editorial' => $editorial,
    'ano_public' => $ano_public,
    'ejemplar' => $ejemplar
]);

if ($res) {
    echo "Libro agregado correctamente";
    header("Location: libros_lista.php");
    exit;
} else {
    echo "Error al agregar libro";
}
?>
