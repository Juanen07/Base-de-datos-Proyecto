<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Iniciar sesión</title>
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" media="screen" href="main.css">
  <script src="main.js"></script>
  <style>
        body {
        background-image: url("imagenes/admin.jpg");
        background-size: cover;
        background-repeat: no-repeat;
        margin: 0;
        height: 100vh;
    }
    
    .container {
      max-width: 400px;
      margin: 150px auto;
      padding: 20px;
      border: 1px solid #ccc;
    }

    .container h2 {
      text-align: center;
      color: #fff;
    }

    .form-group {
      margin-bottom: 20px;
    }

    .form-group label {
      display: block;
      margin-bottom: 5px;
    }

    .form-group input {
      width: 100%;
      padding: 5px;
      font-size: 16px;
    }

    .form-group .error-message {
      color: red;
      margin-top: 5px;
    }

    .form-group .btn {
      width: 100%;
      padding: 10px;
      font-size: 16px;
      background-color: #4CAF50;
      color: white;
      border: none;
      cursor: pointer;
    }

    .form-group .register-link {
      text-align: center;
      margin-top: 10px;
    }
  </style>  
</head>
<body>
  <div class="container">
    <h2>Iniciar sesión</h2>
    <form action="sesion.php" method="POST">
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
      </div>
      <div class="form-group">
        <label for="contrasena">Contraseña:</label>
        <input type="password" id="contrasena" name="contrasena" required>
      </div>
      <?php if (isset($error)): ?>
        <div class="form-group error-message"><?php echo $error; ?></div>
      <?php endif; ?>
      <div class="form-group">
        <input type="submit" value="Iniciar sesión" class="btn">
      </div>
    </form>
  </div>
</body>
</html>
