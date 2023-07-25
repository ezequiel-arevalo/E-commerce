<?php

// Importar las clases necesarias
use App\Auth\Autenticacion;
use App\Models\Usuario;

// Iniciar la sesión y cargar el archivo de autoloading
session_start();
require_once __DIR__ . '/../../bootstrap/autoload.php';

// Verificar si el usuario está autenticado
if (!(new Autenticacion())->estaAutenticadoComoAdmin()) {
    $_SESSION['mensajeError'] = "¡Se requiere haber iniciado sesión para ver este contenido!";
    header("Location: ../index.php?s=_iniciar-sesion");
    exit;
}

$id                = $_GET['id'];
$usuarios_email    = $_POST['email'];
$usuarios_username = $_POST['username'];

// Obtener el usuario a editar por su ID
$usuario = (new Usuario())->porId($id);

// Verificar si el usuario existe
if (!$usuario) {
    $_SESSION['mensajeError'] = 'El usuario no existe.';
    header('Location: ../index.php?s=_usuarios');
    exit;
}

$errores = [];

// Aquí puedes realizar validaciones y agregar errores al array $errores si es necesario.

if (count($errores) > 0) {
    $_SESSION['errores'] = $errores;
    $_SESSION['oldData'] = $_POST;
    header("Location: ../index.php?s=_usuarios-editar&id=" . $id);
    exit;
}

try {
    // Editar el usuario en la base de datos
    (new Usuario())->editar($id, [
        'usuarios_email' => $usuarios_email,
        'usuarios_username' => $usuarios_username,
    ]);

    $_SESSION['mensajeExito'] = "El usuario con ID " . $id . " se editó correctamente.";
    header("Location: ../index.php?s=_gestion-usuarios");
    exit;
} catch (Exception $e) {
    $_SESSION['mensajeError'] = 'Ocurrió un problema inesperado al tratar de editar el usuario.';
    $_SESSION['oldData'] = $_POST;
    header("Location: ../index.php?s=_usuarios-editar&id=" . $id);
    exit;
}
