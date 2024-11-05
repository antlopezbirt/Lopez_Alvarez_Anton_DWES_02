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

//var_dump($_POST); // Para testear

// Si se reciben datos los valida, en caso contrario saca un aviso.
if (count($_POST) > 0) echo validarFormulario();
else echo "No se recibieron datos del <a href='index.php'>formulario</a>";

?>

</body>
</html>