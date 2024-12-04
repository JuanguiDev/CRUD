<?php
    include "datos_conexion/conexion.php";  // Archivo para conectar la base de datos

    // Verificamos si el formulario fue enviado con el botón 'iniciar'
    if (isset($_POST["iniciar"])) {

        // Convertimos el nombre y la contraseña en minuscula para evitar problemas
        $usuario = strtolower($_POST["username"]);
        $contrasena = strtolower($_POST["password"]);

        // Preparamos una consulta SQL para evitar inyecciones SQL
        $sql = "SELECT * FROM usuario WHERE Usuario = ? AND Contraseña = ?";
        $stmt = $mysqli->prepare($sql); // Preparacion de la consulta
        $stmt->bind_param("ss", $usuario, $contrasena); // Se vinculan los parámetros (ambos son cadenas)
        $stmt->execute();   // Se ejecuta la consulta
        $resultado = $stmt->get_result();   // Obtenemos los resultados

        // Validamos si se encuentra un registro que coincida con el usuario y contraseña
        if ($resultado->num_rows == 1) {
            // Si coinciden los datos, nos redirige a equipos.php
            header("location: equipos.php");
        } else {
            // Si no coinciden, muestra una alerta.
            $error = "Usuario y/o contraseña incorrectos";
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión</title>
    <!-- Estilo para el diseño del formulario -->
    <style>
        /* Estilo general del cuerpo */
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Contenedor principal del formulario */
        .login-container {
            height: 400px;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 350px;
        }

        /* Imagen del perfil */
        .login-container img {
            width: 170px;
            height: 170px;
            margin-top: -85px;
            border-radius: 50%;
            margin-bottom: 0px
        }

        /* Encabezado del formulario */
        .login-container h2 {
            margin-top: 40px;
            margin-bottom: 40px;
        }

        /* Campos de entrada */
        .login-container input[type="text"], .login-container input[type="password"] {
            width: 85%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        /* Botón de envío */
        .login-container input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        /* Efecto hover en el botón */
        .login-container input[type="submit"]:hover {
            background-color: #45a049;
        }

        /* Estilo para los mensajes de error */
        .error {
            color: red;
        }
    </style>
    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- Alertas-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="login-container">
        <!-- Imagen del perfil -->
        <img src="Imagenes/profile.png" alt="Imagen de perfil">
        <!-- Titulo -->
        <h2>Iniciar Sesión</h2>
        <!-- Formulario -->
        <form action="index.php" method="post">
            <!-- Campo para ingresar el nombre del usuario -->
            <label for="username">Nombre de Usuario</label>
            <input type="text" id="username" name="username" required>
            
            <!-- Campo para ingresar la contraseña del usuario -->
            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" required>
            
            <!-- Boton para enviar el formulario -->
            <input type="submit" value="Iniciar Sesión" name="iniciar">
        </form>
        <!-- Mostrar mensaje de error si existe -->
        <?php if(isset($error)) { echo '<p class="error">' . $error . '</p>'; } ?>
    </div>
</body>
</html>