<?php
    session_start();
    // Si no hay datos de validación redirige al formulario
    if (!isset($_SESSION['validado'])) header('Location: index.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserva incorrecta</title>
</head>
<body>
    <?//=$_SESSION['errores']?>
    <?php

        // NOMBRE
        if (!$_SESSION['validado']['nombre']) echo "<span style='background: red;'>Nombre está vacío.<br>";
        else echo "<span style='background: green;'>Nombre: {$_SESSION['usuario']['nombre']}.<br>";

        // APELLIDOS
        if (!$_SESSION['validado']['apellidos']) echo "<span style='background: red;'>Apellidos está vacío.<br>";
        else echo "<span style='background: green;'>Apellidos: {$_SESSION['usuario']['apellidos']}.<br>";

        // DNI
        if (!$_SESSION['validado']['dni']) echo "<span style='background: red;'>DNI no válido.<br>";
        else echo "<span style='background: green;'>DNI: {$_SESSION['usuario']['dni']}.<br>";

        // USUARIO
        if (!$_SESSION['validado']['usuario'])  echo "<span style='background: red;'>El usuario no es válido.<br>";
        else echo "<span style='background: green;'>El usuario es válido.<br>";

        // DISPONIBILIDAD
        if (!$_SESSION['validado']['disponible']) echo "<span style='background: red;'>Ese modelo no está disponible en esas fechas o el intervalo no es válido.<br>";
        else echo "<span style='background: green;'>El modelo está disponible en esas fechas.<br>";

        // FECHA
        if (!$_SESSION['validado']['fecha']) echo "<span style='background: red;'>La fecha debe ser posterior a la actual.<br>";
        else echo "<span style='background: green;'>La fecha es válida.<br>";

        // DURACION
        if (!$_SESSION['validado']['duracion']) echo "<span style='background: red;'>La duración debe ser un número entero entre 1 y 30 (ambos incluidos).<br>";
        else echo "<span style='background: green;'>Duración: {$_SESSION['reserva']['duracion']} días.<br>";

    ?>
</body>
</html>
<?php
    // La sesión se destruye al volver al formulario por no tener session_start(),
    // pero aquí se destruye explícitamente ya que finaliza el proceso.
    session_destroy();
?>