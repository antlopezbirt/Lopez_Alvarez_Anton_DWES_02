<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validación reserva</title>
</head>
<body>

<?php

require_once('datos.php');
include_once('funciones.php');

//var_dump($_POST);

$validado = true;
$cadenaErrores = '';

if (trim($_POST['nombre']) === '') {
    $cadenaErrores .= "<span style='background: red;'>Nombre está vacío.<br>";
    $validado = false;
} else {
    $cadenaErrores .= "<span style='background: green;'>Nombre: {$_POST['nombre']}.<br>";
}

if (trim($_POST['apellidos']) === '') {
    $cadenaErrores .= "<span style='background: red;'>Apellidos está vacío<br>";
    $validado = false;
} else {
    $cadenaErrores .= "<span style='background: green;'>Apellidos: {$_POST['apellidos']}.<br>";
}

if (!validarDNI($_POST['dni'])) {
    $cadenaErrores .= "<span style='background: red;'>DNI no válido: {$_POST['dni']}<br>";
    $validado = false;
} else {
    $cadenaErrores .= "<span style='background: green;'>DNI: {$_POST['dni']}.<br>";
}

if (!validarUsuario($_POST['nombre'], $_POST['apellidos'], $_POST['dni'])) {
    $cadenaErrores .= "<span style='background: red;'>El usuario no es válido<br>";
    $validado = false;
} else {
    $cadenaErrores .= "<span style='background: green;'>El usuario es válido.<br>";
}

if (!validarFecha($_POST['fecha'])) {
    $cadenaErrores .= "<span style='background: red;'>La fecha ({$_POST['fecha']}) debe ser posterior a la actual<br>";
    $validado = false;
} else {
    $cadenaErrores .= "<span style='background: green;'>La fecha es válida.<br>";
}

if (!validarDuracion((int) $_POST['duracion'])) {
    $cadenaErrores .= "<span style='background: red;'>La duración debe ser un número entero entre 1 y 30 (ambos incluidos).<br>";
    $validado = false;
} else {
    $cadenaErrores .= "<span style='background: green;'>Duración: {$_POST['duracion']} días.<br>";
}

if (!reservarModelo((int) $_POST['modelo'])) {
    $cadenaErrores .= "<span style='background: red;'>Ese modelo no está disponible.<br>";
    $validado = false;
} else {
    $cadenaErrores .= "<span style='background: green;'>El modelo está disponible.<br>";
}

if ($validado) {
    echo "<h1>" . $_POST['nombre'] . " " . $_POST['apellidos'] . "</h1><br><img src='img/{$_POST['modelo']}.jpg'>";
} else {
    echo $cadenaErrores;
}

?>

</body>
</html>