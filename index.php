<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario reserva vehículo</title>
</head>
<body>
    <form action='validacion.php' method='post'>
        <label for="nombre">Nombre: </label><input type="text" name="nombre" placeholder="Manolo"><br>
        <label for="apellidos">Apellidos: </label><input type="text" name="apellidos" placeholder="Fernández"><br>
        <label for="dni">DNI: </label><input type="text" name="dni" placeholder="54463217X"><br>
        <label for="modelo">Modelo: </label><select name="modelo"><br>
            <option value="1">Lancia Stratos</option>
            <option value="2">Audi Quattro</option>
            <option value="3">Ford Escort RS1800</option>
            <option value="4">Subaru Impreza 555</option>
        </select><br>
        <label for="fecha">Fecha reserva: </label><input type="date" name="fecha"><br>
        <label for="duracion">Duración: </label><input type="number" name="duracion"> días<br>
        <br>
        <input type="submit" value="Enviar">
    </form>
</body>
</html>