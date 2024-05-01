<?php
include 'funciones/comprobarSesion.php';
echo "<div class='link divALaIzquierda'><a href=\"ingreso.php\">Regresar</a></div><br><br>";
echo "<div align='center' style='font-weight: bold; font-size: 40px;'>Alta de Profesores</div><br>";
echo "<HR noshade align='center' style='margin-bottom: 30;'>";
?>

<html>
<head>
    <title>Alta de Profesores</title>
    <script src="JS/jquery-3.3.1.min.js"></script>
    <script>
        function valida() {
            var codigo = document.forma01.codigo.value;
            var nombre = document.forma01.nombre.value;
            var carrera = document.forma01.carrera.value;
            var correo = document.forma01.correo.value;

            if (codigo.trim() === "" || nombre.trim() === "" || carrera.trim() === "" || correo.trim() === "") {
                $('#mensaje').html('Faltan campos por llenar');
                setTimeout(function () {
                    $('#mensaje').html('');
                }, 5000);
                return false;
            }

            // Validar que el código tenga exactamente 9 dígitos
            if (codigo.length !== 7 || isNaN(codigo)) {
                alert("El código debe tener exactamente 7 dígitos");
                return false;
            }

            // Validar que el nombre no esté vacío y contenga solo letras y espacios
            if (!nombre.match(/^[A-Za-z\s]+$/)) {
                alert("El nombre solo debe contener letras y espacios");
                return false;
            }

            // Validar que la carrera no esté vacía y contenga solo letras
            if (!carrera.match(/^[A-Za-z]+$/)) {
                alert("La carrera solo debe contener letras");
                return false;
            }

            // Validar que el correo tenga un formato válido
            if (!correo.match(/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/)) {
                alert("El correo electrónico no tiene un formato válido");
                return false;
            }

        }
    </script>
    <style>
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
    </style>
</head>
<body>
<!-- Formulario de alta de profesores -->
<form enctype="multipart/form-data" name="forma01" action="profesor_salva.php" method="POST" align="center">
    <input type="hidden" name="id" id="id">
    <label style="background-color: pink" for="codigo">Código</label>
    <input type="text" name="codigo" placeholder="Escribe el código del profesor">
    <br>
    <label style="background-color: pink" for="nombre">Nombre</label>
    <input type="text" name="nombre" placeholder="Escribe el nombre del profesor">
    <br>
    <label style="background-color: pink" for="carrera">Carrera</label>
    <input type="text" name="carrera" placeholder="Escribe la carrera del profesor">
    <br>
    <label for="correo" style="margin: 2px 0px 0px 430px; background-color: pink">Correo</label>
    <input type="email" name="correo" id="correo" placeholder="Escribe el correo del profesor">
    <div id='mensaje2' style="margin: 2px 180px 0px 0px;"></div>
    <br>
    <input style="background-color: goldenrod; width: 150px; margin: 10px auto;" onclick="return valida();" type="submit" value="Alta">
</form>
<div id='mensaje'></div>
</body>
</html>
