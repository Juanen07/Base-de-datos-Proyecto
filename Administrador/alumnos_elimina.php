<?php
    include 'funciones/comprobarSesion.php';
    require "funciones/conecta.php";
    $con = conecta();

    //Recibe variables
    $codigo = $_REQUEST['id'];

    //Solo nombre SELECT id, nombre FROM administradores ....
 
    $sql = "UPDATE alumno 
            SET eliminado = 1
            WHERE codigo = $codigo";
    $res = $con->query($sql);

    echo $res;
?>