
<?php
//Equipo 2
//Bases de datos
//Seccion D03
//Chavez Saucedo Brain Jesus
//De Alba Velarde Christian Moises
//Diaz Lopez Juan Enrique
//Fierros Casas Diego Armando
function conecta() {
    $conexion = pg_connect("host=localhost dbname=biblioteca user=postgres password=12345678");

    if (!$conexion) {
        die("Error de conexión: " . pg_last_error());
    }

    return $conexion;
}
?>
