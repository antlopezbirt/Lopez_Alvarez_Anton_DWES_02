<?php

declare(strict_types = 1);

// Función que usa a todas las demás.
// Coordina la validación de todos los datos enviados desde el formulario
function validarFormulario() {

    // Este boolean controla si alguna validación ha fallado
    $validado = true;
    // La cadena va acumulando cada mensaje de error para mostrarlos al finalizar
    $_SESSION['errores'] = '';

    // Comprobación nombre vacío
    if (trim($_SESSION['usuario']['nombre']) === '') {
        $_SESSION['errores'] .= "<span style='background: red;'>Nombre está vacío.<br>";
        $validado = false;
    } else {
        $_SESSION['errores'] .= "<span style='background: green;'>Nombre: {$_SESSION['usuario']['nombre']}.<br>";
    }
    
    // Comprobación apellidos vacíos
    if (trim($_SESSION['usuario']['apellidos']) === '') {
        $_SESSION['errores'] .= "<span style='background: red;'>Apellidos está vacío.<br>";
        $validado = false;
    } else {
        $_SESSION['errores'] .= "<span style='background: green;'>Apellidos: {$_SESSION['usuario']['apellidos']}.<br>";
    }
    
    // Valida DNI
    if (!validarDNI($_SESSION['usuario']['dni'])) {
        $_SESSION['errores'] .= "<span style='background: red;'>DNI no válido.<br>";
        $validado = false;
    } else {
        $_SESSION['errores'] .= "<span style='background: green;'>DNI: {$_SESSION['usuario']['dni']}.<br>";
    }
    
    // Valida usuario
    if (!validarUsuario($_SESSION['usuario']['nombre'], $_SESSION['usuario']['apellidos'], $_SESSION['usuario']['dni'])) {
        $_SESSION['errores'] .= "<span style='background: red;'>El usuario no es válido.<br>";
        $validado = false;
    } else {
        $_SESSION['errores'] .= "<span style='background: green;'>El usuario es válido.<br>";
    }
    
    // Valida fecha
    if (!validarFecha($_SESSION['reserva']['fecha'])) {
        $_SESSION['errores'] .= "<span style='background: red;'>La fecha debe ser posterior a la actual.<br>";
        $validado = false;
    } else {
        $_SESSION['errores'] .= "<span style='background: green;'>La fecha es válida.<br>";
    }
    
    // Valida duración
    if (!validarDuracion((int) $_SESSION['reserva']['duracion'])) {
        $_SESSION['errores'] .= "<span style='background: red;'>La duración debe ser un número entero entre 1 y 30 (ambos incluidos).<br>";
        $validado = false;
    } else {
        $_SESSION['errores'] .= "<span style='background: green;'>Duración: {$_SESSION['reserva']['duracion']} días.<br>";
    }
    
    // Valida disponibilidad modelo
    if (!validarModelo((int) $_SESSION['reserva']['modelo'])) {
        $_SESSION['errores'] .= "<span style='background: red;'>Ese modelo no está disponible.<br>";
        $validado = false;
    } else {
        $_SESSION['errores'] .= "<span style='background: green;'>El modelo está disponible.<br>";
    }
    
    // Si todo ha ido bien, devuelve el mensaje de éxito, en caso contrario los mensajes
    if ($validado) header('Location: exito.php');
    else header('Location: fracaso.php');
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
        if ($usuario["nombre"] === $nombre && 
            $usuario["apellido"] === $apellidos && 
            $usuario["dni"] === $dni) 
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

// Valida la disponibilidad de un modelo, comprobando los datos
function validarModelo(int $modelo) {
    global $coches;
    foreach ($coches as $coche) {
        if ($coche["id"] === $modelo && $coche["disponible"] === true)
            return true;
    }

    return false;
}