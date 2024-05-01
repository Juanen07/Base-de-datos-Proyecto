<?php
    include 'funciones/comprobarSesion.php';
    echo "<div class='link divALaIzquierda'><a href=\"ingreso.php\">Regresar</a></div><br><br>";
    echo "<div align='center' style='font-weight: bold; font-size: 40px;'>Alta de Libros</div><br>";
    echo "<HR noshade align='center' style='margin-bottom: 30;'>";
?>

<html>
 <head>
  <title>Alta de Libros</title>
  <script src="JS/jquery-3.3.1.min.js"></script>
  <script>
    function valida() {
    var isbn = document.forma01.isbn.value;
    var titulo = document.forma01.titulo.value;
    var autor = document.forma01.autor.value;
    var editorial = document.forma01.editorial.value;
    var ano_public = document.forma01.ano_public.value;
    var ejemplar = document.forma01.ejemplar.value;
    
    if (isbn.trim() === "" || titulo.trim() === "" || autor.trim() === "" || editorial.trim() === "" || ano_public.trim() === "" || ejemplar.trim() === "") {
        $('#mensaje').html('Faltan campos por llenar');
        setTimeout(function() {
            $('#mensaje').html('');
        }, 5000);
        return false;
    }
}
  </script>
   <style>
    .divALaIzquierda {
        margin: 2% 0px 0px 5%;
    }

    label{
      display: inline-block;
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
  </style>
 </head>
 <body>
    <!-- Formulario de altas de libros -->
    <form enctype="multipart/form-data" name="forma01" action="libros_salva.php" method="POST" align="center">
        <input type="hidden" name="id" id="id">
        <label style="background-color: pink;" for="isbn">ISBN</label>
        <input type="text" name="isbn" placeholder="Escribe el ISBN del libro">
        <br>
        <label style="background-color: pink;" for="titulo">Título</label>
        <input type="text" name="titulo" placeholder="Escribe el título del libro">
        <br>
        <label style="background-color: pink;" for="autor">Autor</label>
        <input type="text" name="autor" placeholder="Escribe el autor del libro">
        <br>
        <label style="background-color: pink;" for="editorial">Editorial</label>
        <input type="text" name="editorial" placeholder="Escribe la editorial del libro">
        <br>
        <label style="background-color: pink;" for="ano_public">Año de publicación</label>
        <input type="text" name="ano_public" placeholder="Escribe el año de publicación del libro">
        <br>
        <label style="background-color: pink;" for="ejemplar">Ejemplar</label>
        <input type="text" name="ejemplar" placeholder="Escribe el número de ejemplar del libro">
        <br>
        <input style="background-color: goldenrod; width: 150px; margin: 10px auto;" onclick="return valida();" type="submit" value="Alta">
    </form>
    <div id='mensaje'></div>
 </body>
</html>
