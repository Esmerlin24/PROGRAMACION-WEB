<?php
require_once "php/conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = trim($_POST["nombre"]);
    $correo = trim($_POST["correo"]);
    $contrasena = trim($_POST["contrasena"]);
    $confirmar = trim($_POST["confirmar"]);

    if (empty($nombre) || empty($correo) || empty($contrasena) || empty($confirmar)) {
        $mensaje_php = "Todos los campos son obligatorios.";
    } 
    elseif ($contrasena !== $confirmar) {
        $mensaje_php = "Las contraseñas no coinciden.";
    }
    else {

        $hash = password_hash($contrasena, PASSWORD_DEFAULT);

        try {
            $sql = "INSERT INTO usuarios (nombre, correo, contrasena) 
                    VALUES (:nombre, :correo, :contrasena)";

            $stmt = $conexion->prepare($sql);

            $stmt->bindParam(":nombre", $nombre);
            $stmt->bindParam(":correo", $correo);
            $stmt->bindParam(":contrasena", $hash);

            if ($stmt->execute()) {
                $mensaje_php = "Registro exitoso 🎉";
            } else {
                $mensaje_php = "Error al registrar.";
            }

        } catch (PDOException $e) {
            $mensaje_php = "Error en el servidor: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Crear Cuenta – CineMundo</title>

<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/registro.css">

</head>
<body>

<header class="header">
    <div class="logo">CineMundo</div>
    <nav class="nav">
        <ul>
            <li><a href="index.html">Inicio</a></li>
            <li><a href="peliculas.html">Películas</a></li>
            <li><a href="cartelera.html">Cartelera</a></li>
            <li><a href="registro.php" class="active">Registro</a></li>
            <li><a href="contacto.html">Contacto</a></li>
        </ul>
    </nav>
</header>

<section class="registro-seccion">
    <h2>Crear cuenta para reservar entradas</h2>

   <form id="registroForm" method="POST" action="registro.php">


        <label>Nombre completo:</label>
        <input id="nombre" type="text" name="nombre" placeholder="Ingresa tu nombre">


        <label>Correo electrónico:</label>
       <input id="correo" type="text" name="correo" placeholder="Ingresa tu correo">


        <label>Contraseña:</label>
        <input id="password" type="password" name="contrasena" placeholder="Ingresa tu contraseña">


        <label>Confirmar contraseña:</label>
       <input id="confirmar" type="password" name="confirmar" placeholder="Repite tu contraseña">


        <button type="submit">Registrarme</button>

        <p id="mensaje">
            <?php if(isset($mensaje_php)) echo $mensaje_php; ?>
        </p>

    </form>
</section>

<footer class="footer">
    <p>Contacto: +1 809 123 4567 | correo@cinemundo.com</p>
    <p>© 2025 CineMundo. Todos los derechos reservados.</p>
</footer>
<script src="js/registroscript.js"></script>

</body>
</html>





