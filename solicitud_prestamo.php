<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Solicitud de Préstamo</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f1f1f1;
        margin: 0;
        padding: 0;
    }
    
    body {
        background-image: url("imagenes/imagen3.jpg");
        background-size: cover;
        background-repeat: no-repeat;
        margin: 0;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .container {
        max-width: 500px;
        margin: 0 auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    h1 {
        text-align: center;
        color: #333;
    }

    label {
        font-weight: bold;
    }

    input[type="text"],
    input[type="submit"],
    select {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 3px;
        box-sizing: border-box;
    }

    input[type="submit"] {
        background-color: #28a745; /* verde */
        color: #fff;
        cursor: pointer;
        display: block;
        margin: 0 auto;
        width: 50%;
    }

    input[type="submit"]:hover {
        background-color: #218838; /* verde más oscuro al pasar el mouse */
    }

    .message {
        text-align: center;
        font-weight: bold;
        color: #007bff;
    }

    .link {
        color: white;
        text-align: left;
        margin-bottom: 10px;
    }

    .link a {
        color: white;
        text-decoration: none;
        background-color: #007bff;
        padding: 5px 10px;
        border-radius: 3px;
    }
</style>
</head>
<body>
<div class="container">
    <h1>Solicitud de Préstamo de Libro</h1>
    <form action="prestamo_libro.php" method="post">
        <label for="tipo_usuario">Tipo de Usuario:</label>
        <select id="tipo_usuario" name="tipo_usuario" required>
            <option value="">Seleccione</option>
            <option value="alumno">Alumno</option>
            <option value="profesor">Profesor</option>
        </select>

        <label for="codigo_usuario">Código de Usuario:</label>
        <input type="text" id="codigo_usuario" name="codigo_usuario" required>

        <label for="isbn">ISBN del Libro:</label>
        <input type="text" id="isbn" name="isbn" required>
        
        <input type="submit" value="Solicitar Préstamo">
    </form>
    <div class="message" id="message"></div>
    <div class="link"><a href="login.php">Regresar</a></div>
</div>
</body>
</html>
