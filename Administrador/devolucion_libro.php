<?php

$host = 'localhost';
$dbname = 'biblioteca';
$user = 'postgres';
$password = '12345678';

include 'funciones/comprobarSesion.php';
// Conexión a la base de datos con PDO
try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

$tipo_usuario = $_POST['tipo_usuario'];
$codigo_usuario = $_POST['codigo_usuario'];

// Verificar si el usuario es alumno o profesor y obtener el ID correspondiente
$tabla_usuario = ($tipo_usuario == 'alumno') ? 'alumno' : 'profesores';
$campo_usuario = ($tipo_usuario == 'alumno') ? 'codigo' : 'codigo';
$sql_id_usuario = "SELECT $campo_usuario FROM $tabla_usuario WHERE $campo_usuario = :codigo";
$stmt_id_usuario = $pdo->prepare($sql_id_usuario);
$stmt_id_usuario->bindParam(':codigo', $codigo_usuario);
$stmt_id_usuario->execute();
$id_usuario = $stmt_id_usuario->fetchColumn();

if (!$id_usuario) {
    die("El usuario no existe en la base de datos.");
}

// Obtener el ISBN del libro a devolver
$isbn = $_POST['isbn'];

// Verificar si el libro está prestado
$sql_libro_prestado = "SELECT id FROM prestamos WHERE (id_alumno = :id_usuario OR id_profesor = :id_usuario) AND isbn = :isbn AND fecha_devolucion IS NULL";
$stmt_libro_prestado = $pdo->prepare($sql_libro_prestado);
$stmt_libro_prestado->bindParam(':id_usuario', $id_usuario);
$stmt_libro_prestado->bindParam(':isbn', $isbn);
$stmt_libro_prestado->execute();
$libro_prestado = $stmt_libro_prestado->fetch();

if (!$libro_prestado) {
    die("El libro no estaba prestado.");
}

// Actualizar la fecha de devolución en la tabla prestamos
$sql_devolucion = "UPDATE prestamos SET fecha_devolucion = CURRENT_DATE WHERE (id_alumno = :id_usuario OR id_profesor = :id_usuario) AND isbn = :isbn AND fecha_devolucion IS NULL";
$stmt_devolucion = $pdo->prepare($sql_devolucion);
$stmt_devolucion->bindParam(':id_usuario', $id_usuario);
$stmt_devolucion->bindParam(':isbn', $isbn);
$stmt_devolucion->execute();

// Actualizar el adeudo por retraso
$adeudo = 0; // Inicializamos el adeudo en 0

// Verificar si la fecha de devolución es posterior a la fecha ideal
$sql_prestamo = "SELECT fecha_ideal FROM prestamos WHERE (id_alumno = :id_usuario OR id_profesor = :id_usuario) AND isbn = :isbn AND fecha_devolucion IS NOT NULL";
$stmt_prestamo = $pdo->prepare($sql_prestamo);
$stmt_prestamo->bindParam(':id_usuario', $id_usuario);
$stmt_prestamo->bindParam(':isbn', $isbn);
$stmt_prestamo->execute();
$fecha_ideal = $stmt_prestamo->fetchColumn();

$fecha_devolucion = date('Y-m-d');
if (strtotime($fecha_devolucion) > strtotime($fecha_ideal)) {
    $dias_retraso = (strtotime($fecha_devolucion) - strtotime($fecha_ideal)) / (60 * 60 * 24);
    $adeudo = $dias_retraso * 5; // 5 pesos por día de retraso
}

// Actualizar el adeudo en la tabla prestamos
$sql_actualizar_adeudo = "UPDATE prestamos SET adeudo = adeudo + :adeudo WHERE id = :id_prestamo";
$stmt_actualizar_adeudo = $pdo->prepare($sql_actualizar_adeudo);
$stmt_actualizar_adeudo->bindParam(':adeudo', $adeudo);
$stmt_actualizar_adeudo->bindParam(':id_prestamo', $libro_prestado['id'], PDO::PARAM_INT);
$stmt_actualizar_adeudo->execute();

// Actualizar el adeudo en la tabla correspondiente (alumno o profesores)
$sql_actualizar_adeudo_usuario = "UPDATE $tabla_usuario SET adeudo = adeudo + :adeudo WHERE $campo_usuario = :codigo_usuario";
$stmt_actualizar_adeudo_usuario = $pdo->prepare($sql_actualizar_adeudo_usuario);
$stmt_actualizar_adeudo_usuario->bindParam(':adeudo', $adeudo);
$stmt_actualizar_adeudo_usuario->bindParam(':codigo_usuario', $codigo_usuario);
$stmt_actualizar_adeudo_usuario->execute();

// Mostrar el adeudo por retraso si es mayor que cero
echo '<div style="text-align: center; padding: 20px; border: 2px solid #ccc; border-radius: 10px; background-color: #f9f9f9; margin: 20px auto; max-width: 600px;">';
echo '<p style="font-size: 18px; font-weight: bold; margin-bottom: 10px;">¡Devolución realizada con éxito!</p>';
if ($adeudo > 0) {
    echo "<p>Adeudo por retraso: $adeudo pesos.</p>";
} else {
    echo "<p>No hay adeudo por retraso.</p>";
}
echo '</div>';
// Mostrar el adeudo total del usuario
$sql_adeudo_total = "SELECT adeudo FROM $tabla_usuario WHERE $campo_usuario = :codigo_usuario";
$stmt_adeudo_total = $pdo->prepare($sql_adeudo_total);
$stmt_adeudo_total->bindParam(':codigo_usuario', $codigo_usuario);
$stmt_adeudo_total->execute();
$adeudo_total = $stmt_adeudo_total->fetchColumn();

echo '<div style="text-align: center; margin-top: 20px;">';
echo '<a href="ingreso.php" style="padding: 10px 20px; background-color: #007bff; color: #fff; text-decoration: none; border-radius: 5px;">Volver al inicio</a>';
echo '</div>';
?>
