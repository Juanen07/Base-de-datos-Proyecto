<?php
require "funciones/conecta.php";

$conexion = conecta();

$query = "SELECT isbn, id_ejemplar, fecha_prestamo, id_alumno, id_profesor FROM prestamos";
$resultado = pg_query($conexion, $query);

while ($fila_libro = pg_fetch_assoc($resultado)) {
    // Obtener datos de la tabla 'prestamos'
    $isbn = $fila_libro['isbn'];
    $id_ejemplar = $fila_libro['id_ejemplar'];
    $fecha_devolucion = strtotime($fila_libro['fecha_prestamo']);
    $id_alumno = $fila_libro['id_alumno'];
    $id_profesor = $fila_libro['id_profesor'];

    // Consulta para obtener título y autor del libro
    $query2 = "SELECT titulo, autor FROM libros WHERE isbn = '$isbn'";
    $resultado2 = pg_query($conexion, $query2);
    $fila_libro_info = pg_fetch_assoc($resultado2);

    // Obtener datos del libro
    $titulo_libro = $fila_libro_info['titulo'];
    $autor_libro = $fila_libro_info['autor'];

    // Verificar si se obtuvieron filas
    if (!empty($id_alumno)){
        $query3 = "SELECT nombre, correo FROM alumno WHERE codigo = '$id_alumno'";
        $resultado3 = pg_query($conexion, $query3);
        $fila_alumno = pg_fetch_assoc($resultado3);
        $nombre = $fila_alumno['nombre'];
        $correo = $fila_alumno['correo'];
    }
    if (!empty($id_profesor)) {
        $query4 = "SELECT nombre, correo FROM profesores WHERE codigo = '$id_profesor'";
        $resultado4 = pg_query($conexion, $query4);
        $fila_profe = pg_fetch_assoc($resultado4);
        $nombre = $fila_profe['nombre'];
        $correo = $fila_profe['correo'];
    }
    $headers = "From: remitente@example.com" . "\r\n" .
           "Reply-To: remitente@example.com" . "\r\n" .
           "X-Mailer: PHP/" . phpversion();
    if ((time() - $fecha_devolucion) / (60 * 60 * 24) >= 3 && (time() - $fecha_devolucion) / (60 * 60 * 24)<4){
        $asunto= "Recordatorio de devolución de libro";
        $mensaje= "Estimado/a usuario,\n$nombre\nLe recordamos que el libro \"$titulo_libro\" de $autor_libro prestado debe ser devuelto. Por favor, haga los arreglos necesarios.";;
        if(mail($correo, $asunto, $mensaje, $headers)){
        echo 'Correo enviado correctamente aviso';
        }
    }
    if((time() - $fecha_devolucion) / (60 * 60 * 24) >= 8){
        $asunto = "Recargo por devolución tardía de libro";
        $mensaje =  "Estimado/a usuario,\n$nombre\nLe informamos que se ha aplicado un recargo por la devolución tardía del libro \"$titulo_libro\" de $autor_libro. Y cada dia aumentara $5, favor de devolverlo cuanto antes";
        if(mail($correo, $asunto, $mensaje, $headers)){
        echo 'Correo enviado correctamente tarde';
        }
        
    }
}

session_start();

$conexion = conecta();

$usuario = $_POST['email'];
$clave = $_POST['contrasena'];

$query = "SELECT * FROM administradores WHERE email = '$usuario' AND contrasena = '$clave'";
$result = pg_query($conexion, $query);

if (pg_num_rows($result) > 0) {
    $_SESSION['nombre_usuario'] = $usuario;
    header("location: ingreso.php");
} else {
    echo "Datos incorrectos!";
}

pg_close($conexion);
?>
