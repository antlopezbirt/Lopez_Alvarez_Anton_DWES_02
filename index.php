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
            <option>Lancia Stratos</option>
            <option>Audi Quattro</option>
            <option>Ford Escort RS1800</option>
            <option>Subaru Impreza 555</option>
        </select><br>
        <label for="fecha">Fecha reserva: </label><input type="date" name="fecha"><br>
        <label for="duracion">Duración: </label><input type="number" name="duracion" placeholder="5"> días<br>
        <br>
        <input type="submit" value="Enviar">
    </form>
</body>
</html>