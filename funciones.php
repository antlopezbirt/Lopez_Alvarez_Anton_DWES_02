<?php

declare(strict_types = 1);


// Función que usa a todas las demás.
// Coordina la validación de todos los datos enviados desde el formulario
function validarFormulario() {

    // Comprobación nombre vacío
    $_SESSION['validado']['nombre'] = (trim($_SESSION['usuario']['nombre']) === '') ? false : true;
    
    // Comprobación apellidos vacíos
    $_SESSION['validado']['apellidos'] = (trim($_SESSION['usuario']['apellidos']) === '') ? false : true;
    
    // Valida DNI
    $_SESSION['validado']['dni'] = (!validarDNI($_SESSION['usuario']['dni'])) ? false : true;
        
    // Valida usuario
    $_SESSION['validado']['usuario'] = (!validarUsuario($_SESSION['usuario']['nombre'], 
                                            $_SESSION['usuario']['apellidos'], 
                                            $_SESSION['usuario']['dni'])) ? false : true;
    // Valida fecha
    $_SESSION['validado']['fecha'] = (!validarFecha($_SESSION['reserva']['fecha'])) ? false : true;

    // Valida duración
    $_SESSION['validado']['duracion'] = (!validarDuracion((int) $_SESSION['reserva']['duracion'])) ? false : true;

    // Valida disponibilidad modelo
    $_SESSION['validado']['disponible'] = (!validarModelo($_SESSION['reserva']['modelo'], 
                                                $_SESSION['coches'])) ? false : true;
    
    // Si no hay ningún FALSE en el array de validación, redirecciona a la página de éxito, en caso contrario a la de fracaso.
    if (array_search(false, $_SESSION['validado'])) header('Location: fracaso.php');
    else header('Location: exito.php');
}


// Valida un DNI usando el algoritmo de módulo 23
function validarDNI(string $dni) {
    $numero = (int) substr($dni, 0, 8);
    $letra = substr($dni, -1, 1);

    $letraValida = substr('TRWAGMYFPDXBNJZSQVHLCKE', $numero % 23, 1);

    if ($letra === $letraValida) return true;
    
    return false;
}

// Valida un usuario comprobando que exista en la estructura de datos
function validarUsuario(string $nombre, string $apellidos, string $dni) {
    foreach (USUARIOS as $usuario) {
        if ($usuario['nombre'] === $nombre && 
            $usuario['apellido'] === $apellidos && 
            $usuario['dni'] === $dni) 
            return true;
    }

    return false;
}

// Valida una fecha de inicio, comprobando que sea mayor que la actual
function validarFecha(string $fecha) {
    return (strtotime($fecha) > time());
}

// Valida una duración, comprobando que se encuentre en el rango requerido
function validarDuracion(int $duracion) {
    return ($duracion >= 1 && $duracion <= 30);
}

// Valida la disponibilidad de un modelo, chequeando la estructura datos
function validarModelo(string $modelo, array $coches) {

    // Como hay que calcular si el modelo está disponible en para determinadas fechas,
    // primero se comprueba la validez de la fecha y la duración. Si no son válidas, devolverá FALSE directamente.
    if (validarFecha($_SESSION['reserva']['fecha']) && validarDuracion((int) $_SESSION['reserva']['duracion'])) {
        foreach ($coches as $coche) {
            // Si coincide el modelo, inicia el análisis de la disponibilidad
            if ($coche['modelo'] === $modelo) {
                // Si está marcado como disponible,
                if ($coche['disponible'] === true || 
                    // o si la fecha de inicio de reserva es posterior al fin de la ocupación del vehículo,
                    strtotime($coche['fecha_fin']) < strtotime(($_SESSION['reserva']['fecha'])) ||
                    // o si el fin de la reserva (inicio + duración) es anterior al inicio de la ocupación...
                    strtotime($coche['fecha_inicio']) > (strtotime($_SESSION['reserva']['fecha']) + $_SESSION['reserva']['duracion'] * 60 * 60 * 24)
                ) { // ...se interpreta que el vehículo está libre.
                    // Guarda el ID del modelo para luego acceder a la imagen. Se podría enviar directamente desde el value del formulario.
                    $_SESSION['reserva']['idModelo'] = $coche['id'];
                    return true;
                }
            }
        }
    }

    return false;
}