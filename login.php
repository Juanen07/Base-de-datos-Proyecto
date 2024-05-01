<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca Virtual</title>
    <style>
        /* Estilos generales */
        body {
            background-image: url("imagenes/imagen3.jpg");
        background-size: cover;
        background-repeat: no-repeat;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: white;
        }
        /* Estilos del menú */
        .menu {
            display: flex;
            justify-content: center;
            margin-bottom: 30px;
        }
        .menu a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
            padding: 10px 20px;
            margin: 0 10px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            transition: background-color 0.3s;
        }
        .menu a:hover {
            background-color: #f0f0f0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Biblioteca Virtual</h1>
        <div class="menu">
            <a href="libros_lista.php">Libros</a>
            <a href="solicitud_prestamo.php">Prestamos</a>
            <a href="formulario_devolucion.php">Entregas</a>
        </div>
        <!-- Aquí puedes agregar más contenido -->
    </div>
</body>
</html>
