<?php
session_start();
require_once('datos.php');
include_once('funciones.php');

//var_dump($_POST); // Para testear

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