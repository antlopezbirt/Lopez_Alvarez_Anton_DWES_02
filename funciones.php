<?php

declare(strict_types = 1);

function validarDNI(string $dni) {
    $numero = (int) substr($dni, 0, 8);
    $letra = substr($dni, -1, 1);

    $letraValida = substr('TRWAGMYFPDXBNJZSQVHLCKE', $numero % 23, 1);

    if ($letra === $letraValida) return true;
    
    return false;
}

function validarUsuario(string $nombre, string $apellidos, string $dni) {
    foreach (USUARIOS as $usuario) {
        if ($usuario["nombre"] === $nombre && 
            $usuario["apellido"] === $apellidos && 
            $usuario["dni"] === $dni) 
            return true;
    }

    return false;
}

function validarFecha(string $fecha) {
    return (strtotime($fecha) > time());
}

function validarDuracion(int $duracion) {
    return ($duracion >= 1 && $duracion <= 30);
}

function reservarModelo(int $modelo) {
    global $coches;
    foreach ($coches as $coche) {
        if ($coche["id"] === $modelo && $coche["disponible"] === true)
            return true;
    }

    return false;
}