<?php
session_start();
require_once('usuarios_y_coches.php');
include_once('funciones.php');

// Recoge en la sesión solo los datos de los coches de usuarios_y_coches.php
// Con los datos de usuarios no haría falta ya que las constantes tienen scope global
// https://www.php.net/manual/en/language.constants.php 
$_SESSION['coches'] = $coches;

// Si se reciben datos los pasa a la sesión y los valida, en caso contrario saca un aviso.
if (count($_POST) > 0) {
    $_SESSION['usuario']['nombre'] = $_POST['nombre'];
    $_SESSION['usuario']['apellidos'] = $_POST['apellidos'];
    $_SESSION['usuario']['dni'] = $_POST['dni'];
    $_SESSION['reserva']['modelo'] = $_POST['modelo'];
    $_SESSION['reserva']['fecha'] = $_POST['fecha'];
    $_SESSION['reserva']['duracion'] = $_POST['duracion'];

    validarFormulario();
}

else echo "No se recibieron datos del <a href='index.php'>formulario</a>";