<?php

use App\Auth\Autenticacion;

session_start();
require_once __DIR__ . '/../../bootstrap/autoload.php';

// Cerrar sesión llamando al método correspondiente en la clase Autenticacion
(new Autenticacion())->cerrarSesion();

// Establecer un mensaje de éxito en la sesión
$_SESSION['mensajeExito'] =  "¡La sesión se cerró con éxito!";

// Redirigir al usuario a la página de inicio de sesión
header("Location: ../index.php?s=_iniciar-sesion");
exit;