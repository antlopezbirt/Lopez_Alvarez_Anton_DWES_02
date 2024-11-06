<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>¡Reserva exitosa!</title>
</head>
<body>
    <h1><?=$_SESSION['usuario']['nombre'] . " " . $_SESSION['usuario']['apellidos']?></h1>
    <br>
    <img src='img/<?=$_SESSION['reserva']['modelo']?>.jpg'>
</body>
</html>
<?php
    // La sesión se destruye al volver al formulario por no tener session_start(),
    // pero aquí se destruye explícitamente
    session_destroy();
?>