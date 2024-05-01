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
$codigo = $_REQUEST['codigo'];
$nombre = $_REQUEST['nombre'];
$carrera = $_REQUEST['carrera'];
$correo = $_REQUEST['correo'];

// Validar campos
if (empty($codigo) || empty($nombre) || empty($carrera) || empty($correo)) {
    echo "Faltan campos por llenar";
    exit;
}

// Verificar que el código tenga 9 dígitos
if (strlen($codigo) !== 7 || !is_numeric($codigo)) {
    echo "El código debe tener 7 dígitos numéricos";
    exit;
}

// Verificar que el correo tenga un formato válido
if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    echo "El correo electrónico no tiene un formato válido";
    exit;
}

// Preparar la consulta SQL
$sql = "INSERT INTO profesores (codigo, nombre, carrera, correo) VALUES (:codigo, :nombre, :carrera, :correo)";
$stmt = $con->prepare($sql);

// Ejecutar la consulta
$res = $stmt->execute([
    'codigo' => $codigo,
    'nombre' => $nombre,
    'carrera' => $carrera,
    'correo' => $correo
]);

if ($res) {
    echo "Profesor agregado correctamente";
    header("Location: profesor_lista.php");
    exit;
} else {
    echo "Error al agregar profesor";
}
?>

