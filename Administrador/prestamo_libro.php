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

// Obtener el tipo de usuario y el código de usuario
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

// Obtener el ISBN del libro a prestar
$isbn = $_POST['isbn'];

// Verificar si el libro está disponible
$sql_disponible = "SELECT id_ejemplar FROM libros WHERE isbn = :isbn AND status = true LIMIT 1";
$stmt_disponible = $pdo->prepare($sql_disponible);
$stmt_disponible->bindParam(':isbn', $isbn);
$stmt_disponible->execute();
$ejemplar_disponible = $stmt_disponible->fetch(PDO::FETCH_ASSOC);

if (!$ejemplar_disponible) {
    die("El libro no está disponible para préstamo.");
}

// Calcular la fecha de devolución (7 días después de la fecha de préstamo)
$fecha_prestamo = date('Y-m-d'/*, strtotime('-6 days')*/);
$fecha_ideal = date('Y-m-d', strtotime($fecha_prestamo . ' + 7 days'));

// Iniciar la transacción para realizar el préstamo
try {
    $pdo->beginTransaction();

    // Insertar el préstamo en la tabla de préstamos
    $sql_prestamo = "INSERT INTO prestamos (id_alumno, id_profesor, isbn, id_ejemplar, fecha_prestamo, fecha_ideal)
                     VALUES (:id_alumno, :id_profesor, :isbn, :id_ejemplar, :fecha_prestamo, :fecha_ideal)";
    $stmt_prestamo = $pdo->prepare($sql_prestamo);
    $id_alumno = ($tipo_usuario == 'alumno') ? $id_usuario : null;
    $stmt_prestamo->bindParam(':id_alumno', $id_alumno, PDO::PARAM_INT);
    $id_profesor = ($tipo_usuario == 'profesor') ? $id_usuario : null;
    $stmt_prestamo->bindParam(':id_profesor', $id_profesor, PDO::PARAM_INT);
    $stmt_prestamo->bindParam(':isbn', $isbn);
    $stmt_prestamo->bindParam(':id_ejemplar', $ejemplar_disponible['id_ejemplar'], PDO::PARAM_INT);
    $stmt_prestamo->bindParam(':fecha_prestamo', $fecha_prestamo);
    $stmt_prestamo->bindParam(':fecha_ideal', $fecha_ideal);
    $stmt_prestamo->execute();

    // Actualizar el estado del libro a prestado
    $sql_actualizar_estado = "UPDATE libros SET status = false WHERE isbn = :isbn AND id_ejemplar = :id_ejemplar";
    $stmt_actualizar_estado = $pdo->prepare($sql_actualizar_estado);
    $stmt_actualizar_estado->bindParam(':isbn', $isbn);
    $stmt_actualizar_estado->bindParam(':id_ejemplar', $ejemplar_disponible['id_ejemplar'], PDO::PARAM_INT);
    $stmt_actualizar_estado->execute();

    // Confirmar la transacción
    $pdo->commit();

    echo '<div style="text-align: center; padding: 20px; border: 2px solid #ccc; border-radius: 10px; background-color: #f9f9f9;">';
    echo '<p style="font-size: 18px; font-weight: bold; margin-bottom: 10px;">¡La solicitud de préstamo ha sido exitosa!</p>';
    echo "<p>Fecha de devolución: $fecha_ideal</p>";
    echo "<p>¡Disfruta de tu lectura!</p>";
    echo '</div>';

} catch (PDOException $e) {
    // Revertir la transacción en caso de error
    $pdo->rollBack();
    die("Error al realizar el préstamo: " . $e->getMessage());
}

echo '<div style="text-align: center; margin-top: 20px;">';
echo '<a href="ingreso.php" style="padding: 10px 20px; background-color: #007bff; color: #fff; text-decoration: none; border-radius: 5px;">Volver al inicio</a>';
echo '</div>';
?>
