<?php
    include 'funciones/comprobarSesion.php';
    include 'funciones/menu.php';
    echo "<div class='link divALaIzquierda'><a href=\"alumno_lista.php\">Regresar al listado</a></div><br><br>";
    echo "<div align='center' style='font-weight: bold; font-size: 40px;'>Edición de Alumnos</div><br>";
    echo "<HR noshade align='center' style='margin-bottom: 30;'>";

    require "funciones/conecta.php";
    $con = conecta();

    //Recibe variables
    $id = $_REQUEST['id'];

    $sql = "SELECT * FROM alumno WHERE codigo = $id";
 
    $res = $con->query($sql);

    $row = $res->fetch_array();
    $nombre = $row["nombre"];
    $carrera = $row["carrera"];
    $correo = $row["correo"];
    $adeudo = $row["adeudo"];
?>

<html>
 <head>
  <title>Edición de Alumnos</title>
  <script src="JS/jquery-3.3.1.min.js"></script>
  <script>
    // Código JavaScript para validar y manipular el formulario
  </script>
    <style>
    .divALaIzquierda {
        margin: 2% 0px 0px 5%;
    }

    label{
      display: inline-block;
      width: 80px;
    }

    .claseCorreo {
      float: left;
      position: relative; 
      width: 80px;
    }

    input, textarea, select {
      width: 250px;
      margin:2px auto;
      box-sizing: border-box;
    }

    body {
      background: url("imagenes/Admin12.jpg"); 
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
        height:20px;
        line-height:20px;
        border: 2px solid black;
        color: #F00;
        font-size: 16px;
        font-weight: bold;
        width: 250px;
        text-align: center;
        margin:2px auto;
    }

    #mensaje2 {
      height:20px;
      line-height:22px;
      color: #F00;
      font-size: 15px;
      font-weight: bold;
      width: 250px;
      text-align: center;
      float: right;
      position: relative;
    }
  </style>
 </head>
 <body>
    <form enctype="multipart/form-data" name="forma01" action="alumnos_salvaEditar.php" method="POST" align="center">
    <input type="hidden" name="id" id="id" value="<?php echo $id ?>">
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" placeholder="Escribe tu nombre" value="<?php echo $nombre ?>">
    <br>
    <label for="carrera">Carrera</label>
    <input type="text" name="carrera" placeholder="Escribe tu carrera" value="<?php echo $carrera ?>">
    <br>
    <label for="correo">Correo</label>
    <input type="email" name="correo" placeholder="Escribe tu correo" value="<?php echo $correo ?>">
    <br>
    <label for="adeudo">Adeudo</label>
    <input type="text" name="adeudo" placeholder="Adeudo" value="<?php echo $adeudo ?>">
    <br>
    <input style="background-color: goldenrod; width: 150px; margin: 10px auto;" onclick="return valida();" type="submit" value="Editar">
    </form>
    <div id='mensaje'></div>
 </body>
</html>
